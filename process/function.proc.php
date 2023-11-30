<?php
require 'db.proc.php';

#Function to display error
function display_error(){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

#Function total number of record from liste table
function count_query($con){
    $query_count = "SELECT COUNT(*) AS total_agent FROM liste  ";
	$result_count = mysqli_query($con, $query_count);
    $rs_count = mysqli_fetch_assoc($result_count);
    return $rs_count;
}

/*
function record_mat($con, $matricule){
    $query = "SELECT * FROM liste WHERE matricule = $matricule  ";
	$rs_record = mysqli_query($con, $query);
    $record = mysqli_fetch_assoc($rs_record);
    return $record;
}
*/

#Query to extract liste of all agent in liste table
function list_agent($con){
	$query = "SELECT * FROM liste  ";
	$result = mysqli_query($con, $query);
    return $result;
}

#Query to extract  all arrived agent for particular date
function liste_presence($con){
    //Create Select Query
	date_default_timezone_set('Africa/Kinshasa');
	$today = date('Y-m-d');
    $query = "SELECT L.matricule, L.grade, L.nom, L.postnom, A.arrive, A.depart, A.dates FROM liste  AS L INNER JOIN arriveDepart AS A ON L.matricule = A.matricule  WHERE dates = DATE('$today') ORDER BY A.arrive DESC";
	$shouts = mysqli_query($con, $query);
    return $shouts;
}


#Generate 8 random alpha numerique characters
function randomString($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }

    return $str;
}