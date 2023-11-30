<?php

#Import files
include 'db.proc.php';
include 'function.proc.php';

#Function to display error if exist
display_error();


#Check if matricule is captured
$matricule = $_POST['matricule'] ?? null;
if (!$matricule) {
    header('Location: ../enregistrement.php');
    exit;
}

// Insert data into the database
$query = "DELETE FROM liste WHERE matricule = '$matricule'";
if(!mysqli_query($con, $query)){
die('Error: '.mysqli_error($con));
} else {
header("Location: ../enregistrement.php");
exit();
}