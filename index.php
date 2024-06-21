<?php
session_start();

// Set a session variable to indicate that the user has visited the index page
$_SESSION['visited_index'] = true;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votinator</title>
    <link rel="stylesheet" href="./front-end/CSS/index.css">
    <link rel="icon" href="./img//logo-black.png" type="image/png">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' https://trusted-cdn.com;">

</head>
<body>

    <div class="centered-container">
        <h1>Safe. Voting.</h1>
        <div class="button-group">
            <a href="./front-end/Inform-User/AtHome.php">
                <button id="button1">Authenticate Me</button>
             </a>
        </div>
        <p><tiny>We're not a scam website (trust)</tiny></p>
    </div>
    
</body>
</html>
