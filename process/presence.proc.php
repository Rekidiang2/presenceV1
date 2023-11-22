<?php
include 'db.proc.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//Check if form submitted

// Check if form is submitted
if (isset($_POST['arrive'])) {
    // Sanitize and retrieve matricule from the form
    $matricule = trim(mysqli_real_escape_string($con, $_POST['matricule']));

    // Set timezone
    date_default_timezone_set('Africa/Kinshasa');
    setlocale(LC_ALL, 'fr_FR.UTF-8');
    $dates = date('Y-m-d');
    $arrive = date('H:i:s');

    // Validate matricule
    if (!isset($matricule) || $matricule === '') {
        $error = "Veuillez insérer votre Matricule.";
        header("Location: ../index.php?error=" . urlencode($error));
        exit();
    } else {
        // Check if the matricule exists in the database

        // Query to fetch all matricules from the 'liste' table
        $query1 = "SELECT matricule FROM liste";
        $result = mysqli_query($con, $query1);

        if ($result) {
            // Check if there are rows returned
            if ($result->num_rows > 0) {
                // Loop through each row
                while ($row = mysqli_fetch_assoc($result)) {
                    // Check if the submitted matricule exists in the 'liste' table
                    if ($matricule == $row["matricule"]) {
                        // Query to check if matricule exists for the given date in 'arriveDepart' table
                        $query2 = "SELECT matricule FROM arriveDepart WHERE matricule='$matricule' AND dates= DATE('$dates')";
                        $result2 = mysqli_query($con, $query2);

                        if ($result2) {
                            // Check if there are no rows for the given date and matricule
                            if (!$result2->num_rows > 0) {
                                // Insert the matricule, date, and time of arrival into the 'arriveDepart' table
                                $query3 = "INSERT INTO arriveDepart (matricule, dates, arrive) VALUES ('$matricule','$dates','$arrive')";
                                if (!mysqli_query($con, $query3)) {
                                    die('Error: ' . mysqli_error($con));
                                } else {
                                    // Redirect to index.php on successful insertion
                                    header("Location: ../index.php");
                                    exit();
                                }
                            }
                            // Redirect if the presence has already been signaled for the given date and matricule
                            $error = "Votre présence a déjà été signalée.";
                            header("Location: ../index.php?error=" . urlencode($error));
                            exit();
                        } else {
                            // Redirect on query error while checking the presence
                            $error = "Une erreur s'est produite lors de la vérification de la présence.";
                            header("Location: ../index.php?error=" . urlencode($error));
                            exit();
                        }
                    }
                }
                // Redirect if the matricule is not registered
                $error = "Vous n'êtes pas enregistré.";
                header("Location: ../index.php?error=" . urlencode($error));
                exit();
            } else {
                // Redirect if the 'liste' table is empty
                $error = "La table Agent est vide.";
                header("Location: ../index.php?error=" . urlencode($error));
                exit();
            }
        } else {
            // Redirect on query error while fetching matricules
            $error = "Une erreur s'est produite lors de la récupération des données.";
            header("Location: ../index.php?error=" . urlencode($error));
            exit();
        }
    }
}

      // Check if form submitted
      if (isset($_POST['depart'])) {
          $matricule = trim(mysqli_real_escape_string($con, $_POST['matricule']));
      
          // Set timezone
          date_default_timezone_set('Africa/Kinshasa');
          setlocale(LC_ALL, 'fr_FR.UTF-8');
          $dates = date('Y-m-d');
          $depart = date('H:i:s');
      
          // Validate matricule
          if (!isset($matricule) || $matricule === '') {
              $error = "Veuillez insérer votre Matricule.";
              header("Location: ../index.php?error=" . urlencode($error));
              exit();
          } else {
              $query7 = "SELECT matricule, dates FROM arriveDepart";
              $result7 = mysqli_query($con, $query7);
      
              if ($result7) {
                  while ($row = mysqli_fetch_assoc($result7)) {

                      if (($matricule === $row["matricule"]) && ($dates === $row["dates"])) {
                        
                          if (date('H') >= 11) {
                              $query8 = "UPDATE arriveDepart SET depart = '$depart' WHERE matricule = '$matricule' AND dates = DATE('$dates') AND arrive IS NOT NULL";
      
                              if (!mysqli_query($con, $query8)) {
                                  die('Error: ' . mysqli_error($con));
                              } else {
                                  header("Location: ../index.php");
                                  exit();
                              }
                          } else {
                              $error = "Veuillez attendre l'heure du départ.";
                              header("Location: ../index.php?error=" . urlencode($error));
                              exit();
                          }
                      } 

                      
                  }

                    $error = "Signalez d'abord votre présence.";
                    header("Location: ../index.php?error=" . urlencode($error));
                    exit();

              } else {
                  $error = "Une erreur s'est produite lors de la récupération des données.";
                  header("Location: ../index.php?error=" . urlencode($error));
                  exit();
              }
          }
      }
      