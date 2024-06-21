<?php
function generateKeyIv($password, $salt) {
    $key = hash_pbkdf2("sha256", $password, $salt, 10000, 32, true);
    $iv = substr(hash_pbkdf2("sha256", $password, $salt, 10000, 16, true), 0, 16);
    return [$key, $iv];
}

// Generate the key and display it
$password = "securepassword";
$salt = openssl_random_pseudo_bytes(16);
list($key, $iv) = generateKeyIv($password, $salt);
file_put_contents('secure-folder/key.txt', base64_encode($key));

echo "Key generated and saved to secure-folder/key.txt.\n";

// Destroy the key file after displaying it
unlink('secure-folder/key.txt');
?>
