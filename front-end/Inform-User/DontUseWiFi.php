<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votinator</title>
    <link rel="stylesheet" href="../../front-end/CSS/index.css">
    <link rel="icon" href="../../img/logo-black.png" type="image/png">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' https://trusted-cdn.com;">

</head>
<body>
    <div class="centered-container">
        <h1>Some Routers do not have the safest standards <br> You could be sending your information without protection. Even if we are protecting it from the website people can read your address and everything. Best to Switch Now</h1>
        <div class="button-group">
            <a href="./AreYouSure_WiFi.php">
                <button id="button1">I'll switch to a mobile network</button>
            </a>

        </div>
        <div class="button-group">
            <a href="./AreYouSure_WiFi.php">
                <button id="button2">My wifi is completely secure (not advised)</button>
            </a>

        </div>
    </div>
</body>
</html>
