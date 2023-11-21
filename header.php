<?php
  session_start();
  //include_once 'includes/functions.inc.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>header</title>
    <link rel="icon" href="images/logo-esu.png">

    <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/styles.css">
    

</head>
<body>
    <!-- header section starts  -->
    <section class="header">
    <a href="index.php" class="logo"><img src="images/logo-ced.png" alt="Gestion des Presences" width=300>

    <nav class="navbar">
    <a href="index.php">Home</a>
    <a href="enregistrement.php">Enregitrement</a>
    <a href="rapport.php">Rapport</a>
    
    <?php
      if (isset($_SESSION["useruid"])) {
        $jus = ucfirst($_SESSION['useruid']);
        echo "<a href='profile1.php'><span id='menu-profile'>$jus</span></span></a>  ";
        // echo ucfirst($_SESSION["useruid"]);         
        echo "<a href='logout.php'><span id='menu-decon'>Déconnecter</span></a>";    
        }
      else {
        echo "<a href='signup.php' class='menu-btn'></a>";
        echo "<a href='login.php' class='menu-btn'></a>";
        }
    ?>

    </nav>
   
    <div id="menu-btn" class="fas fa-bars"></div>

    </section>

    <!-- header section ends -->

    <script src="js/script.js"></script>

</body>
</html>