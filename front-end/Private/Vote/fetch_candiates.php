<?php
// Database connection settings
$servername = "localhost";
$username = "roote";
$password = "";
$dbname = "upler";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get all candidates
$sql = "SELECT Name, Elder, Num_Times_Poked, Evil_Plan FROM yondora";
$result = $conn->query($sql);

$candidates = [];

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $candidates[] = $row;
    }
} else {
    echo "0 results";
}
$conn->close();

// Shuffle the candidates
shuffle($candidates);

// Return the shuffled list as JSON
header('Content-Type: application/json');
echo json_encode($candidates);
?>
