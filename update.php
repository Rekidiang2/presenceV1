<?php
include "process/db.proc.php";

include "process/function.proc.php";

$matricule = $_GET['matricule'] ?? null;

if (!$matricule) {
    header('Location: enregistrement.php');
    exit;
}

$query = "SELECT * FROM liste WHERE matricule = $matricule  ";
	$rs_record = mysqli_query($con, $query);
    $record = mysqli_fetch_assoc($rs_record);
    
    $matricule = $record['matricule'];
	$nom = $record['nom'];
	$postnom = $record['postnom'];
	$grade = $record['grade'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $matricule = $_POST['matricule'];
	$nom = $_POST['nom'];
	$postnom = $_POST['postnom'];
	$grade = $_POST['grade'];
    
        $image = $_FILES['image'] ?? null;
        $imagePath = '';
    
        if (!is_dir('images')) {
            mkdir('images');
        }
    
        if ($image) {
            if ($record['image']) {
                unlink($record['image']);
            }
            $imagePath = 'images/' . randomString(8) . '/' . $image['name'];
            mkdir(dirname($imagePath));
            move_uploaded_file($image['tmp_name'], $imagePath);
        }
    
        //Validate input
	if(!isset($nom) || $nom == '' || !isset($postnom) || $postnom == '' || !isset($grade) || $grade == ''){
		$error = "Please fill in your name and a message";
		header("Location: ../enregistrement.php?error=".urlencode($error));
		exit();
	} else {
		// Insert data into the database
		$query = "UPDATE liste SET nom = $nom, postnom, = $postnom grade = $grade, image = $image";

		
		if(!mysqli_query($con, $query)){
			die('Error: '.mysqli_error($con));
		} else {
			header("Location: ../enregistrement.php");
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
    <link href="css/styles.css" rel="stylesheet"/>
    <title>Update</title>
</head>
<body>
<div class="sub-header">
        <p class="left-title">Enregistrement</p>

        <div id="rigth-title">
            <p class="left-title"> Updade : <?php  echo $record['nom'] ?></p>
        </div>
    </div>

    <section class="main">
        <div class="container1 flex-container"> 
            <div id="input">
                <div class="heading">
                    <h3>Update : <b><?php echo $record['nom'] ?> - Matricule : <?php echo $matricule ?></h3>
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
                        <label>Grade</label>
                            <input type="text" name="grade" value="<?php echo $grade ?>">
                        </div>
                        <div>
                        <input type="file" name="image">
                        <img src="/opt/lampp/htdocs/presenceV1/upload/z4z3Fljr/mbilia.jpeg" alt="" style="width: 50px;">
                        </div>

                        <input type="submit" name="submit" class="submit-btn" value="Enregistre"
                            aria-label="Sizing example input">
                        
                    </div>
                </form>
                <img src="/opt/lampp/htdocs/presenceV1/upload/z4z3Fljr/mbilia.jpeg" alt="" style="width: 50px;">
            </div>
            <?php if ($product['image']): ?>
        <img src="<?php echo $product['image'] ?>" class="product-img-view">
    <?php endif; ?>

        </div>

        <?php if ($product['image']): ?>
        <img src="<?php echo $product['image'] ?>" class="product-img-view">
    <?php endif; ?>




</body>
</html>