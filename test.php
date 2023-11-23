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

// Get form data
$name = $_POST['name'];
$image = $_FILES['image']['tmp_name']; // Temporary file path of the uploaded image
$imageData = addslashes(file_get_contents($image)); // Convert image to binary data

// Prepare and execute SQL query
$sql = "INSERT INTO imageTable (name, image) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $name, $imageData);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Record inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
