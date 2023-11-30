<?php

//Connect to MySQL
$host="localhost";
$username="root";
$pwd="";
$db="presences";

$con = mysqli_connect($host, $username, $pwd,$db);

//Test Connection
if(mysqli_connect_errno()){
	echo 'Failed to connect to MySQL: '.mysqli_connect_error();
} 