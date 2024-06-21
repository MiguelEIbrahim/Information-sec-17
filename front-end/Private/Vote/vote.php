<?php
session_start();
if (!isset($_SESSION['visited_index']) || $_SESSION['visited_index'] !== true) {
    // Redirect to index.php
    header("Location: /Information-sec-17/index.php");
    exit();
}
header('Content-Type: application/json');

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "upler";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(array('success' => false, 'message' => "Connection failed: " . $conn->connect_error)));
}

// Retrieve and decode the POST data
$postData = json_decode(file_get_contents('php://input'), true);
$profileName = isset($postData['profileName']) ? $postData['profileName'] : '';
$encryptedUserID = isset($postData['encryptedUserID']) ? base64_decode($postData['encryptedUserID']) : '';

if (empty($profileName) || empty($encryptedUserID)) {
    echo json_encode(array('success' => false, 'message' => 'Invalid request.'));
    $conn->close();
    exit();
}

// Anonymize IP and hash MAC for encryption key (adjust as per your server/client setup)
$ip = $_SERVER['REMOTE_ADDR'];
$mac = exec('getmac'); // Adjust as needed for clients
$anonymizedIP = hash('sha256', $ip);
$hashedMAC = hash('sha256', $mac);
$combinedKey = substr(hash('sha256', $anonymizedIP . $hashedMAC), 0, 32);

// Decrypt the user ID
$iv = substr($encryptedUserID, 0, 16); // Assuming the IV is prepended to the encrypted user ID
$encryptedUserID = substr($encryptedUserID, 16);
$userID = openssl_decrypt($encryptedUserID, 'aes-256-cbc', $combinedKey, 0, $iv);

if (!$userID) {
    echo json_encode(array('success' => false, 'message' => 'Failed to decrypt user ID.'));
    $conn->close();
    exit();
}

// Check if user has already voted for this profile
$stmt_check_vote = $conn->prepare("SELECT * FROM Pokes WHERE Bohemian_ID = ? AND Yondora_Name = ?");
$stmt_check_vote->bind_param("is", $userID, $profileName);
$stmt_check_vote->execute();
$stmt_check_vote->store_result();
if ($stmt_check_vote->num_rows > 0) {
    echo json_encode(array('success' => false, 'message' => 'You have already voted for this profile.'));
    $stmt_check_vote->close();
    $conn->close();
    exit();
}
$stmt_check_vote->close();

// Insert vote into Pokes table
$stmt_insert_vote = $conn->prepare("INSERT INTO Pokes (Bohemian_ID, Yondora_Name) VALUES (?, ?)");
$stmt_insert_vote->bind_param("is", $userID, $profileName);
if ($stmt_insert_vote->execute()) {
    // Update the Num_Times_Poked in the Yondora table
    $stmt_update_pokes = $conn->prepare("UPDATE Yondora SET Num_Times_Poked = Num_Times_Poked + 1 WHERE Name = ?");
    $stmt_update_pokes->bind_param("s", $profileName);
    if ($stmt_update_pokes->execute()) {
        echo json_encode(array('success' => true, 'message' => 'Vote successfully recorded.'));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Failed to update profile.'));
    }
    $stmt_update_pokes->close();
} else {
    echo json_encode(array('success' => false, 'message' => 'Failed to record vote.'));
}
$stmt_insert_vote->close();

$conn->close();
?>