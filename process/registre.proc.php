<?php
define ('ENVIRONMENT', 'development');
include 'db.proc.php';


//Check if form submitted
if(isset($_POST['submit'])){
	$matricule = trim(strtoupper(mysqli_real_escape_string($con, $_POST['matricule'])));
	$nom = trim(strtoupper(mysqli_real_escape_string($con, $_POST['nom'])));
	$postnom = trim(strtoupper(mysqli_real_escape_string($con, $_POST['postnom'])));
	$grade = trim(strtoupper(mysqli_real_escape_string($con, $_POST['grade'])));
	
	//Set timezone
	//date_default_timezone_set('America/New_York');
	//$time = date('h:i:s a',time());
	
	
	//Validate input
	if(!isset($matricule) || $matricule == '' || !isset($nom) || $nom == '' || !isset($postnom) || $postnom == '' || !isset($grade) || $grade == ''){
		$error = "Please fill in your name and a message";
		header("Location: registre.php?error=".urlencode($error));
		exit();
	} else {
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