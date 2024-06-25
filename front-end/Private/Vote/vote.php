<?php
session_start();

header('Content-Type: application/json');

// Get the posted data
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['profileName']) || !isset($data['encryptedUserID'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
    exit();
}

$profileName = $data['profileName'];
$encryptedUserID = base64_decode($data['encryptedUserID']);

// Recreate the encryption key and IV
$ip = $_SERVER['REMOTE_ADDR'];
$mac = exec('getmac');
$anonymizedIP = hash('sha256', $ip);
$hashedMAC = hash('sha256', $mac);
$combinedKey = substr(hash('sha256', $anonymizedIP . $hashedMAC), 0, 32);

// Use a fixed IV value for decryption (this should be the same as used during encryption)
$iv = substr(hash('sha256', 'fixed_iv_value'), 0, 16);

// Decrypt the user ID
$decryptedUserID = openssl_decrypt($encryptedUserID, 'aes-256-cbc', $combinedKey, OPENSSL_RAW_DATA, $iv);

if ($decryptedUserID === false) {
    echo json_encode(['success' => false, 'message' => 'Decryption failed']);
    exit();
}

// Connect to database
$conn = new mysqli("localhost", "root", "", "upler"); // Replace with your DB credentials

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user has already voted
$stmt_check_vote = $conn->prepare("SELECT Bohemian_ID FROM Pokes WHERE Bohemian_ID = ? AND Yes = 1");
$stmt_check_vote->bind_param("i", $decryptedUserID);
$stmt_check_vote->execute();
$stmt_check_vote->store_result();

if ($stmt_check_vote->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'You have already voted']);
    $stmt_check_vote->close();
    $conn->close();
    exit();
}

$stmt_check_vote->close();

// Update the vote count in the Yondora table
$stmt_update_vote = $conn->prepare("UPDATE Yondora SET Num_Times_Poked = Num_Times_Poked + 1 WHERE Name = ?");
$stmt_update_vote->bind_param("s", $profileName);

if ($stmt_update_vote->execute()) {
    // Insert into the Pokes table
    $stmt_insert_poke = $conn->prepare("INSERT INTO Pokes (Bohemian_ID, Yes) VALUES (?, 1)");
    $stmt_insert_poke->bind_param("i", $decryptedUserID);

    if ($stmt_insert_poke->execute()) {
        echo json_encode(['success' => true, 'message' => 'Thank you for your vote!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to record vote']);
    }

    $stmt_insert_poke->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update vote count']);
}

$stmt_update_vote->close();
$conn->close();
?>
