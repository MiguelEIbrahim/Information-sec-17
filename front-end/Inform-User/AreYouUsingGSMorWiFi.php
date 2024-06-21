
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
        <h1>Are you using a mobile network (3G/4G/5G) or WiFi?</h1>
        <div class="button-group">
            <a href="./ScanID.php">
                <button id="button1">3G/4G/5G</button>
             </a>

             <a href="./DontUseWiFi.php">
                <button id="button1">WiFi</button>
             </a>
        </div>
        <p>Your WiFi Provider Does not Care that Much about your Security</p>
    </div>
</body>
</html>
