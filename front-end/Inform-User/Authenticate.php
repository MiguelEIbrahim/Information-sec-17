<?php
// Error message variable
$errorMessage = "";

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get user data
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Basic validation (improve as needed)
    if (empty($username) || empty($email) || empty($password)) {
        $errorMessage = "Username, email, and password are required.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Invalid email format.";
    } else {

        // Generate random salt and encryption key
        $salt = base64_encode(random_bytes(16));
        $encryptionKey = base64_encode(random_bytes(32));

        // Generate a secure password hash
        $passwordHash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);

        // Generate a unique OTP
        $otp = rand(100000, 999999);

        // Anonymize IP and hash MAC for encryption key
        $ip = $_SERVER['REMOTE_ADDR'];
        $mac = exec('getmac'); // This will get the MAC address of the server, adjust accordingly for clients
        $anonymizedIP = hash('sha256', $ip);
        $hashedMAC = hash('sha256', $mac);
        $combinedKey = substr(hash('sha256', $anonymizedIP . $hashedMAC), 0, 32);

        // Example sensitive data to be encrypted
        $sensitiveData = "Sensitive data example";
        $iv = openssl_random_pseudo_bytes(16);
        $encryptedMessage = openssl_encrypt($sensitiveData, 'aes-256-cbc', $combinedKey, OPENSSL_RAW_DATA, $iv);

        // Connect to database (replace with your connection details)
        $conn = new mysqli("localhost", "username", "password", "database_name");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute insert query with secure parameters
        $stmt = $conn->prepare("INSERT INTO BohemianNew (Name, AnonymizedIP, HashedMAC, EncryptedMessage, IV) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $anonymizedIP, $hashedMAC, $encryptedMessage, $iv);
        if ($stmt->execute()) {

            // Send OTP email (replace with your email sending logic)
            $subject = "Account Verification for " . $username;
            $message = "Your OTP to verify your account is: " . $otp;
            mail($email, $subject, $message);

            // Success message
            $message = "Account created successfully. Please check your email to verify.";
        } else {
            $errorMessage = "Error creating account: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
</head>
<body>
  <?php if (!empty($errorMessage)) : ?>
    <p style="color: red;"><?= $errorMessage ?></p>
  <?php endif; ?>
  <?php if (isset($message)) : ?>
    <p><?= $message ?></p>
  <?php endif; ?>
  <form method="post">
    <label for="username">Name:</label>
    <input type="text" name="username" id="username" required><br><br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br><br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br><br>
    <input type="submit" value="Sign Up">
  </form>
</body>
</html>
