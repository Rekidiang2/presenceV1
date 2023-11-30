<?php

include 'db.proc.php';
include 'function.proc.php';

display_error();

$matricule = $_GET['matricule'] ?? null;
if (!$matricule) {
    header('Location: ../update.php');
    exit;
}

$query = "SELECT * FROM liste WHERE matricule = $matricule  ";
	$rs_record = mysqli_query($con, $query);
    $record = mysqli_fetch_assoc($rs_record);

	$matricule = trim(strtoupper(mysqli_real_escape_string($con, $_POST['matricule'])));
	$nom = trim(strtoupper(mysqli_real_escape_string($con, $_POST['nom'])));
	$postnom = trim(strtoupper(mysqli_real_escape_string($con, $_POST['postnom'])));
	$grade = trim(strtoupper(mysqli_real_escape_string($con, $_POST['grade'])));

	$image = $_FILES['image'] ?? null;
    $imagePath = '';

    if (!is_dir('../uplaod')) {
        mkdir('../upload');
		
    }
	
    if ($image && $image['tmp_name']) {
        $imagePath = 'upload/' . randomString(8) . '/' . $image['name'];
        mkdir(dirname('../'.$imagePath));
        move_uploaded_file($image['tmp_name'], '../'.$imagePath);
    }
 	
	//Validate input
	if(!isset($matricule) || $matricule == '' || !isset($nom) || $nom == '' || !isset($postnom) || $postnom == '' || !isset($grade) || $grade == ''){
		$error = "Please fill in your name and a message";
		header("Location: registre.php?error=".urlencode($error));
		exit();
	} else {
		// Insert data into the database
		$query = "UPDATE liste (matricule =  $matricule, nom = $NOM, postnom = $postnom, grade = $grade, image=$image";
		
		if(!mysqli_query($con, $query)){
			die('Error: '.mysqli_error($con));
		} else {
			header("Location: ../enregistrement.php");
			exit();
		}
	}