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
        <h1>Are You Sure?</h1>
        <div class="button-group">
            <a href="./ScanID.php">
                <button id="button1">Yes, Ofcourse</button>
             </a>
        </div>
        <p>You Don't want your neighbors to know your full name</p>
    </div>
</body>
</html>
