<?php 
    include 'process/db.inc.php' ; 
    include 'process/function.inc.php';


    display_error();
    
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement</title>
</head>

<body>
    <!--Header-->
    <?php include_once 'header.php'; ?>

    <!--Sub Header -->
    <div class="sub-header">
        <p class="left-title">Enregistrement</p>

        <div id="rigth-title">
            <p class="left-title"> Total : <?php echo count_query($con)['total_agent'];?></p>
        </div>
    </div>

    <section class="main">



    </section>

</body>

</html>