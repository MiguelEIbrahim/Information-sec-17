<?php
require 'vendor/autoload.php';

use phpseclib3\Crypt\EC;
use phpseclib3\Crypt\AES;
use phpseclib3\Crypt\Random;

function generateSalt($length = 16) {
    return random_bytes($length);
}

function encryptName($name, $privateKey, $salt) {
    $aes = new AES('gcm');
    $nonce = random_bytes(12); // Generate a random nonce
    $publicKey = $privateKey->getPublicKey();

    $sharedSecret = $privateKey->createKeyExchange($publicKey);
    $key = hash('sha256', $sharedSecret . $salt, true); // Derive a symmetric key

    $aes->setNonce($nonce);
    $aes->setKey($key);
    $encryptedName = $aes->encrypt($name);

    return [$salt, $nonce, $encryptedName, $publicKey->toString('PKCS8')];
}

function updateNamesToEncrypted($conn) {
    // Fetch names from the database
    $query = "SELECT ID, Name FROM Bohemian";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['ID'];
            $name = $row['Name'];

            // Generate ECC key pair for each name
            $privateKey = EC::createKey('secp256r1');

            // Encrypt the name
            list($salt, $nonce, $encryptedName, $publicKey) = encryptName($name, $privateKey, generateSalt());

            // Update the database with encrypted data
            $updateQuery = $conn->prepare("UPDATE Bohemian SET Salt = ?, Nonce = ?, EncryptedName = ?, PublicKey = ? WHERE ID = ?");
            $updateQuery->bind_param("ssssi", $salt, $nonce, $encryptedName, $publicKey, $id);
            $updateQuery->execute();
        }
    }
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "upler";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update names in the database
updateNamesToEncrypted($conn);

$conn->close();
?>
