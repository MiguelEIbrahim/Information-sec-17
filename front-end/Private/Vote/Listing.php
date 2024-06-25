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
  <?php
  // Database connection details (replace with your actual credentials)
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "upler";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Prepare a secure SQL statement to prevent SQL injection
  $sql = "SELECT Name, Elder, Num_Times_Poked, Evil_Plan FROM yondora";
  $stmt = mysqli_prepare($conn, $sql);

  // Execute the prepared statement
  if (!$stmt->execute()) {
    echo "Error: " . $stmt->error;
  }

  // Bind results to variables (optional, but improves readability)
  $stmt->bind_result($name, $elder, $num_times_poked, $evil_plan);

  // Fetch data from the database
  $profiles = array();
  while ($stmt->fetch()) {
    // Replace spaces in name with underscores for image path
    $imageName = str_replace(' ', '_', $name);

    $profiles[] = array(
      "name" => $name,
      "elder" => $elder,
      "num_times_poked" => $num_times_poked,
      "image" => $imageName . '.jpg', // Assuming jpg format
      "evil_plan" => $evil_plan
    );
  }

  // Close the prepared statement and connection
  $stmt->close();
  $conn->close();

  // Shuffle profiles to randomize their placement
  shuffle($profiles);
  ?>

  <?php foreach ($profiles as $profile): ?>
    <div class="profile-card">
      <h2><?php echo htmlspecialchars($profile["name"]); ?></h2>
      <?php $imagePath = "../img/"; ?>
      <img src="<?php echo $imagePath . $profile['image']; ?>" class="profile-image">
      <p>Age: <?php echo htmlspecialchars($profile["elder"]); ?></p>
      <p><?php echo htmlspecialchars($profile["evil_plan"]); ?></p>
      <button data-profile-name="<?php echo htmlspecialchars($profile["name"]); ?>">Vote</button>
    </div>
  <?php endforeach; ?>
</div>

<div id="modal" class="modal" style="display:none;">
  <div class="modal-content">
    <span class="close-button">&times;</span>
    <div id="profile-details"></div>
  </div>
</div>

<script>
  const voteButtons = document.querySelectorAll('button[data-profile-name]');
  const modal = document.getElementById('modal');
  const profileDetails = document.getElementById('profile-details');
  const closeButton = document.querySelector('.close-button');

  voteButtons.forEach(button => {
    button.addEventListener('click', () => {
      const profileName = button.dataset.profileName;

      // Get the encrypted user ID from local storage
      const encryptedUserID = localStorage.getItem('user_id');

      // Send the vote to the server via AJAX
      fetch('vote.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          profileName: profileName,
          encryptedUserID: encryptedUserID
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          profileDetails.innerHTML = `<p>${data.message}</p>`;
          modal.style.display = 'block';
        } else {
          alert(data.message);
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });
    });
  });

  closeButton.addEventListener('click', () => {
    modal.style.display = 'none';
  });
</script>

</body>
</html>
