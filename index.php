<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <!--Header-->
    <?php include_once 'header.php'; ?>

    <!--Sub-Header-->
    <div class="sub-header">
        <p class="left-title">Liste de Presence</p>

        <div id="rigth-title">
            <p class="left-title">Date : <?php echo date('d-m-Y');?></p>
        </div>
    </div>

    <section class="main">
        <div class="container1 flex-container">
            <div id="input">
              

                <!--Display Error-->
                <?php if(isset($_GET['error'])) : ?>
                <div class="error"><?php echo $_GET['error']; ?></div>
                <?php endif; ?>
                
                <!--Form-->
                <form method="post" action="process/presence.proc.php">
                    <div class="form-group">
                        <div>
                            <input type="text" name="matricule" placeholder="Inserer votre Matricule">
                        </div>
                        
                        <input type="submit" name="arrive" class="submit-btn" value="Signaler Votre Arrive"
                            aria-label="Sizing example input">
                            <input type="submit" name="depart" class="submit-btn" value="Signaler Votre Depart"
                            aria-label="Sizing example input">
                    </div>
                </form>
            </div>

           



        </div>
    </section>








</body>

</html>