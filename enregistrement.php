<?php 
    include 'process/db.proc.php' ; 
    include 'process/function.proc.php';


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
        <div class="container1 flex-container">
            <div id="input">
                <div class="heading">
                    <h3>Ajouter Agent</h3>
                </div>
                <?php if(isset($_GET['error'])) : ?>
                <div class="error"><?php echo $_GET['error']; ?></div>
                <?php endif; ?>
                <form method="post" action="process/registre.proc.php">
                    <div class="form-group">
                        <div>
                            <input type="text" name="nom" placeholder="Nom">
                        </div>
                        <div>
                            <input type="text" name="postnom" placeholder="Postnom">
                        </div>
                        <div>
                            <input type="text" name="matricule" placeholder="Matricule">
                        </div>
                        <div>
                            <input type="text" name="grade" placeholder="Grade">
                        </div>
                        <input type="submit" name="submit" class="submit-btn" value="Enregistre"
                            aria-label="Sizing example input">
                    </div>





                </form>


            </div>



        </div>


    </section>



</body>

</html>