<?php
// Error message variable
$errorMessage = "";

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get user data and sanitize inputs
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $verifyPassword = isset($_POST['verify_password']) ? $_POST['verify_password'] : '';

    // Basic validation
    if (empty($username) || empty($email) || empty($password) || empty($verifyPassword)) {
        $errorMessage = "All fields are required.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Invalid email format.";
    } else if (strlen($password) < 8) {
        $errorMessage = "Password must be at least 8 characters long.";
    } else if ($password !== $verifyPassword) {
        $errorMessage = "Passwords do not match.";
    } else {

        // Generate random salt and encryption key
        $salt = base64_encode(random_bytes(16));
        $encryptionKey = base64_encode(random_bytes(32));

        // Generate a secure password hash
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Generate a unique OTP (for example purposes)
        $otp = rand(100000, 999999);

        // Anonymize IP and hash MAC for encryption key (adjust as per your server/client setup)
        $ip = $_SERVER['REMOTE_ADDR'];
        $mac = exec('getmac'); // Adjust as needed for clients
        $anonymizedIP = hash('sha256', $ip);
        $hashedMAC = hash('sha256', $mac);
        $combinedKey = substr(hash('sha256', $anonymizedIP . $hashedMAC), 0, 32);

        // Example sensitive data to be encrypted
        $sensitiveData = "Sensitive data example";
        $iv = openssl_random_pseudo_bytes(16);
        $encryptedMessage = openssl_encrypt($sensitiveData, 'aes-256-cbc', $combinedKey, OPENSSL_RAW_DATA, $iv);

        // Connect to database (replace with your connection details)
        $conn = new mysqli("localhost", "root", "", "upler"); // Replace with your DB credentials
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if user with the same email already exists
        $stmt_check_email = $conn->prepare("SELECT ID FROM Bohemian WHERE Email = ?");
        $stmt_check_email->bind_param("s", $email);
        $stmt_check_email->execute();
        $stmt_check_email->store_result();
        if ($stmt_check_email->num_rows > 0) {
            $errorMessage = "Account Exists";
            $stmt_check_email->close();
            $conn->close();
            // Handle error or redirect as needed
        } else {
            $stmt_check_email->close();

            // Prepare and execute insert query with secure parameters
            $stmt_insert = $conn->prepare("INSERT INTO Bohemian (Name, AnonymizedIP, HashedMAC, EncryptedMessage, IV, Email) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt_insert->bind_param("ssssss", $username, $anonymizedIP, $hashedMAC, $encryptedMessage, $iv, $email);
            if ($stmt_insert->execute()) {

                // Send OTP email (replace with your email sending logic)
                $subject = "Account Verification for " . $username;
                $message = "Your OTP to verify your account is: " . $otp;
                mail($email, $subject, $message);

                // Redirect to another page after successful registration
                header("Location: ../../../../Information-sec-17/front-end/Private/Vote/Listing.php");
                exit();
            } else {
                $errorMessage = "Error creating account: " . $conn->error;
            }

            $stmt_insert->close();
            $conn->close();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .container label {
            display: block;
            margin-bottom: 5px;
        }

        .container input[type="text"],
        .container input[type="email"],
        .container input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
        }

        .container input[type="submit"]:hover {
            background-color: #218838;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

        .success-message {
            color: green;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
    <title>Sign Up</title>
</head>
<body>
    <div class="container">
        <h2>Sign Up</h2>
        <?php if (!empty($errorMessage)) : ?>
            <p class="error-message"><?= $errorMessage ?></p>
        <?php endif; ?>
        <form method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <label for="verify_password">Verify Password:</label>
            <input type="password" name="verify_password" id="verify_password" required>
            <input type="submit" value="Sign Up">
        </form>
    </div>
</body>
</html>
