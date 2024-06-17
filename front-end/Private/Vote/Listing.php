<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votinator</title>
    <link rel="stylesheet" href="../../../front-end/CSS/listing.css">
    <link rel="icon" href="../../../img/logo-black.png" type="image/png">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' https://trusted-cdn.com;">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

</head>

<body>
    <h1>Minister Profiles</h1>
    <div id="profiles">
        <!-- Profiles will be injected here by JavaScript -->
    </div>

    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <div id="profile-details"></div>
        </div>
    </div>

    <script src="../Js/Summary.js"></script>
</body>
</html>