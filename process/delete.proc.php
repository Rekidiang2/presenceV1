<?php
include 'db.proc.php';
include 'function.proc.php';
display_error();



$matricule = $_POST['matricule'] ?? null;
if (!$matricule) {

echo $matricule;
exit;
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