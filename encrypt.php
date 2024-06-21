<?php
function generateKeyIv($password, $salt) {
    $key = hash_pbkdf2("sha256", $password, $salt, 10000, 32, true);
    $iv = substr(hash_pbkdf2("sha256", $password, $salt, 10000, 16, true), 0, 16);
    return [$key, $iv];
}

function encryptData($data, $password) {
    $salt = openssl_random_pseudo_bytes(16);
    list($key, $iv) = generateKeyIv($password, $salt);
    $encryptedData = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
    $encryptedDataWithSalt = base64_encode($salt . $encryptedData);
    return [$encryptedDataWithSalt, $key];
}

// Example usage
$password = "securepassword";
$data = "This is a secret message.";

// Encrypt data and save to file
list($encryptedData, $key) = encryptData($data, $password);
file_put_contents('secure-folder/encrypted_data.txt', $encryptedData);
file_put_contents('secure-folder/key.txt', base64_encode($key));

// Destroy the key file after encryption
unlink('secure-folder/key.txt');
?>
