<?php include 'process/db.proc.php' ; ?>
<?php
	//Create Select Query
	date_default_timezone_set('Africa/Kinshasa');
	$today = date('Y-m-d');

    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	

	$query = "SELECT L.matricule, L.grade, L.nom, L.postnom, A.arrive, A.depart, A.dates FROM liste  AS L INNER JOIN arriveDepart AS A ON L.matricule = A.matricule  WHERE dates = DATE('$today') ORDER BY A.arrive DESC";
	$shouts = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="css/style.css" type="text/css" />-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
            <div class="heading">
                    <h3>Signalez Votre Presence</h3>
                </div>
              

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
                        
                        <input type="submit" name="arrive" class="submit-btn" value="Arrive"
                            aria-label="Sizing example input">
                            <input type="submit" name="depart" class="submit-btn" value="Depart"
                            aria-label="Sizing example input">
                    </div>
                </form>
            </div>

           



        </div>

        <div class="container1"><br>
        <div class="heading">
                    <h3>Liste de Presence</h3>
                </div>

        <div class="search-container">
        <input type="text" placeholder="Search...">
        <button type="submit">Search</button>
    </div>


            <div id="table-box">

                <table class="table">
                    <thead>
                        <th scope="col">#</th>
                        <th scope="col">Matricule</th>
                        <th scope="col">Grade</th>
                        <th scope="col">Nom et Postnom</th>
                        <th scope="col">Arrive</th>
                        <th scope="col">Depart</th>

                    </thead>
                    <tbody>
                        <?php foreach ($shouts as $i => $product) { ?>
                        <tr>
                            <th scope="row"><?php echo $i + 1 ?></th>
                            <td><?php echo $product['matricule'] ?></td>
                            <td><?php echo $product['grade'] ?></td>
                            <td><?php echo $product['nom'].' '.$product['postnom'] ?></td>
                            <td><?php echo $product['arrive'] ?></td>
                            <td><?php echo $product['depart'] ?></td>

                        </tr>

                        <?php } ?>
                    </tbody>

                </table>

            </div>




        </div>
    </section>






    <?php include_once 'footer.php'; ?>

</body>

</html>