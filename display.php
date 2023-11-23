<?php
// Establish your database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "imageTest";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get image data from the database
$name = 'mkoli'; // Change this to the desired image ID from your database
$sql = "SELECT image FROM imageTable WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $name);
$stmt->execute();

$stmt->bind_result($imageData);
$stmt->fetch();

// Display the image
header("Content-type: image/png"); // Adjust content-type based on your image type
echo $imageData;

$stmt->close();
$conn->close();
?>
