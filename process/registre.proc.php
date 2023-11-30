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

	#Query the DB to obtain a record for particular matricule (primary Key)
	$query = "SELECT * FROM liste WHERE matricule = $matricule";
	$rs_record = mysqli_query($con, $query);
	$record = mysqli_fetch_assoc($rs_record);
	
	
	//Validate input
	if(!isset($matricule) || $matricule == '' || !isset($nom) || $nom == '' || !isset($postnom) || $postnom == '' || !isset($grade) || $grade == ''){
		$error = "Please fill in your name and a message";
		header("Location: ../enregistrement.php?error=".urlencode($error));
		exit();
	} else {

		if($record['matricule']==$matricule){
			$error = "Cet agent existe deja dans la base de donnees";
		header("Location: ../enregistrement.php?error=".urlencode($error));
		exit();

		}
		// Insert data into the database
		$query = "INSERT INTO liste (matricule, nom, postnom, grade)
				VALUES ('$matricule','$nom','$postnom', '$grade')";

		
		if(!mysqli_query($con, $query)){
			die('Error: '.mysqli_error($con));
		} else {
			header("Location: ../enregistrement.php");
			exit();
		}
	}
}