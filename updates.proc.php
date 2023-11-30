<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 

#Import files
include "process/db.proc.php";
include "process/function.proc.php";

#Get matricule value from url and check if it exist
$matricule = $_GET['matricule'] ?? null;
if (!$matricule) {
    header('Location: enregistrement.php');
    exit;
}

#Query the DB to obtain a record for particular matricule (primary Key)
$query = "SELECT * FROM liste WHERE matricule = $matricule  ";
$rs_record = mysqli_query($con, $query);
$record = mysqli_fetch_assoc($rs_record);
  
#Extract each column of the record
$matricule = $record['matricule'];
$nom = $record['nom'];
$postnom = $record['postnom'];
$grade = $record['grade'];

    
#Check if request method is post.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    #Grabe data from form
    $matricule = $_POST['matricule'];
    $nom = $_POST['nom'];
    $postnom = $_POST['postnom'];
    $grade = $_POST['grade'];
      

    #Validate input
    if(!isset($matricule) || $matricule == '' || !isset($nom) || $nom == '' || !isset($postnom) || $postnom == '' || !isset($grade) || $grade == ''){
        $error = "Please fill in your name and a message";
        header("Location: updates.php?error=".urlencode($error));
        exit();
    } else {
        // Insert data into the database
        $query = "UPDATE liste SET nom = '$nom', postnom = '$postnom', grade = '$grade' WHERE matricule = '$matricule'";

        
        if(!mysqli_query($con, $query)){
            die('Error: '.mysqli_error($con));
        } else {
            header("Location: enregistrement.php");
            exit();
        }
    }   
       
}

?>