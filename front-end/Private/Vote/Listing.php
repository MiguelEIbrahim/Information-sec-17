<?php

// Database connection details (replace with your actual credentials)
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "upler";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Prepare a secure SQL statement to prevent SQL injection
$sql = "SELECT Name, Elder, Num_Times_Poked FROM yondora";
$stmt = mysqli_prepare($conn, $sql);

// Execute the prepared statement
if (!$stmt->execute()) {
    echo "Error: " . $stmt->error;
}

// Bind results to variables (optional, but improves readability)
$stmt->bind_result($name, $elder, $num_times_poked);

// Fetch data from the database
$profiles = array();
while ($stmt->fetch()) {
    $profiles[] = array(
        "name" => $name,
        "elder" => $elder,
        "num_times_poked" => $num_times_poked,
    );
}

// Close the prepared statement and connection
$stmt->close();
$conn->close();

?>

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
    <?php foreach ($profiles as $profile): ?>
      <div class="profile-card">
        <h2><?php echo htmlspecialchars($profile["name"]); ?></h2>
        <p>Elder: <?php echo $profile["elder"] ? 'Yes' : 'No'; ?></p>
        <p>Number of Times Poked: <?php echo $profile["num_times_poked"]; ?></p>
        <button data-profile-name="<?php echo htmlspecialchars($profile["name"]); ?>">View Details</button>
      </div>
    <?php endforeach; ?>
  </div>

  <div id="modal" class="modal">
    <div class="modal-content">
      <span class="close-button">&times;</span>
      <div id="profile-details"></div>
    </div>
  </div>

  <script>
    const modal = document.getElementById("modal");
    const closeButton = document.querySelector(".close-button");
    const profileDetails = document.getElementById("profile-details");

    const profileCards = document.querySelectorAll(".profile-card button");
    profileCards.forEach(button => {
      button.addEventListener("click", () => {
        const profileName = button.dataset.profileName;
        // Fetch detailed profile data using AJAX or another method here
        // and update the profileDetails element accordingly
        profileDetails.innerHTML = `<h2>Loading profile details for ${profileName}...</h2>`;
      });
    });

    closeButton.addEventListener("click", () => {
      modal.style.display = "none";
    });

    window.addEventListener("click", (event) => {
      if (event.target === modal) {
        modal.style.display = "none";
      }
    });
  </script>
</body>
</html>