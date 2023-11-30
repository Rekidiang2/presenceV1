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
        $query = "UPDATE liste SET matricule = '$matricule', nom = '$nom', postnom = '$postnom', grade = '$grade' WHERE matricule = '$matricule'";

        
        if(!mysqli_query($con, $query)){
            die('Error: '.mysqli_error($con));
        } else {
            header("Location: enregistrement.php");
            exit();
        }
    }   
       
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet" />
    <title>Mise a Jour</title>
</head>

<body>
<?php include_once 'header.php'; ?>
    <div class="sub-header">
        <p class="left-title">Correction</p>

        <div id="rigth-title">
            <p class="left-title"> Updade : <?php  echo $record['nom'] ?></p>
        </div>
    </div>

    <section class="main">
        <div class="container1 flex-container">
            <div id="input">
                <div class="heading">
                    <h3>Update : <b><?php echo $record['nom'] ?></h3>
                </div>

                <!--Display Error-->
                <?php if(isset($_GET['error'])) : ?>
                <div class="error"><?php echo $_GET['error']; ?></div>
                <?php endif; ?>

                <!--Form-->
                <form method="post" enctype="multipart/form-data">

                    <div class="form-group">


                        <div>
                            <label>Nom</label>
                            <input type="text" name="nom" value="<?php echo $nom ?>">
                        </div>
                        <div>
                            <label>Postnom</label>
                            <input type="text" name="postnom" value="<?php echo $postnom ?>">
                        </div>
                        <div>
                            <label>Matricule</label>
                            <input type="text" name="matricule" value="<?php echo $matricule ?>">
                        </div>
                        <div>
                            <label>Grade</label>
                            <input type="text" name="grade" value="<?php echo $grade ?>">
                        </div>

                        <input type="submit" name="submit" class="submit-btn" value="Update"
                            aria-label="Sizing example input">

                    </div>
                </form>
                
            </div>
            

        </div>

                </section>

        


        

</body>
<?php include_once 'footer.php'; ?>

</html>
