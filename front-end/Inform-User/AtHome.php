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
        <h1>Are you in a safe environment<br> with no Preying Eyes?</h1>
        <div class="button-group">
            <a href="./GoHome.php">
                <button id="button1">No</button>
             </a>
             <a href="./AreYouUsingGSMorWiFi.php">
                <button id="button1">Yes</button>
             </a>
        </div>
        <p>Even your cats</p>
    </div>
</body>
</html>
