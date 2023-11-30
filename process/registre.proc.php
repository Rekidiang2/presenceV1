<?php

include 'db.proc.php';
include 'function.proc.php';

display_error();


//Check if form submitted
if(isset($_POST['submit'])){
	$matricule = trim(strtoupper(mysqli_real_escape_string($con, $_POST['matricule'])));
	$nom = trim(strtoupper(mysqli_real_escape_string($con, $_POST['nom'])));
	$postnom = trim(strtoupper(mysqli_real_escape_string($con, $_POST['postnom'])));
	$grade = trim(strtoupper(mysqli_real_escape_string($con, $_POST['grade'])));

	
	
	
	//Validate input
	if(!isset($matricule) || $matricule == '' || !isset($nom) || $nom == '' || !isset($postnom) || $postnom == '' || !isset($grade) || $grade == ''){
		$error = "Please fill in your name and a message";
		header("Location: ../enregistrement.php?error=".urlencode($error));
		exit();
	} else {
		// Insert data into the database
		$query = "INSERT INTO liste (matricule, nom, postnom, grade, image)
				VALUES ('$matricule','$nom','$postnom', '$grade', '$imagePath')";

		
		if(!mysqli_query($con, $query)){
			die('Error: '.mysqli_error($con));
		} else {
			header("Location: ../enregistrement.php");
			exit();
		}
	}
}