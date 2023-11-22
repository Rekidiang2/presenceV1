<?php
include 'db.proc.php';

display_error();

//Check if form submitted
if(isset($_POST['submit'])){
	
	$nom = trim(strtoupper(mysqli_real_escape_string($con, $_POST['nom'])));
	$postnom = trim(strtoupper(mysqli_real_escape_string($con, $_POST['postnom'])));
	$matricule = trim(strtoupper(mysqli_real_escape_string($con, $_POST['matricule'])));
	$grade = trim(strtoupper(mysqli_real_escape_string($con, $_POST['grade'])));
	
	//Set timezone
	//date_default_timezone_set('America/New_York');
	//$time = date('h:i:s a',time());
	
	
	//Validate input
	if(!isset($nom) || $nom == '' || !isset($postnom) || $postnom == '' || !isset($matricule) || $matricule == '' ||   !isset($grade) || $grade == ''){
		//$error = "Please fill in your name and a message";
		header("Location: regis.php?error=".urlencode($error));
		exit();
	} else {
		$query = "INSERT INTO liste (nom, postnom, matricule, grade)
				VALUES ('$nom','$postnom', '$matricule', '$grade')";
		
		if(!mysqli_query($con, $query)){
			die('Error: '.mysqli_error($con));
		} else {
			header("Location: ../enregistrement.php");
			exit();
		}
	}
}