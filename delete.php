<?php

include 'db.proc.php';

// Check if matricule is set in $_POST
$matricule = $_POST['id'] ?? null;
if (!$matricule) {
    header('Location: enregistrement.php');
    exit;
}

// Prepare the delete query using a prepared statement
$query = "DELETE FROM liste WHERE matricule = ?";
$stmt = mysqli_prepare($con, $query);

if ($stmt) {
    // Bind the parameter and execute the statement
    mysqli_stmt_bind_param($stmt, 's', $matricule);
    mysqli_stmt_execute($stmt);

    // Check if the delete operation was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Deleted successfully, redirect to enregistrement.php
        header("Location: enregistrement.php");
        exit();
    } else {
        // No rows affected, handle accordingly (e.g., already deleted)
        header("Location: enregistrement.php");
        exit();
    }
} else {
    // If there's an error with the prepared statement
    die('Error: ' . mysqli_error($con));
}

// Close the prepared statement and database connection
mysqli_stmt_close($stmt);
mysqli_close($con);
