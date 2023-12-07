<?php 
include 'process/db.proc.php' ; 
include 'process/function.proc.php';

display_error() ;

date_default_timezone_set('Africa/Kinshasa');
        $dater = date('Y-m-d');
        $rapportp = rapport_presence($con, $dater);

        if (isset($_POST['rapport'])) {
            // Sanitize and retrieve matricule from the form
            $dater = trim(mysqli_real_escape_string($con, $_POST['dater']));
          
            $rapportp = rapport_presence($con, $dater);
        } 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="css/style.css" type="text/css" />-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Rapport</title>
</head>

<body>
    <!--Header-->
    <?php include_once 'header.php'; ?>

    <!--Sub-Header-->
    <div class="sub-header">
        <p class="left-title">Rapport</p>
 
        <div id="rigth-title">
            <p class="left-title">Date : <?php echo $dater;?></p>
        </div>
    </div>

    <!--Start section-->
    <section class="main">
        

        <div class="container1"><br>
        <div class="heading">
        <h3>Liste de Presence du <?php echo date_format(date_create($dater), 'd-m-Y')?></h3>     
    </div>
       
<form action="rapport.php" method="POST">
        <div class="date-container">
       
        <input type="date"  name="dater" placeholder="Date..." value="<?php echo date_format(date_create($dater), 'Y-m-d')?>">
        <input type="submit" name="rapport" value="Affiche">
        </form>
    </div>

    


            <div id="table-box">

                <table id="myTable" class="table">
                    <thead>
                        <th scope="col">#</th>
                        <th scope="col">Nom et Postnom</th>
                        <th scope="col">Grade</th>
                        <th scope="col">Arrive</th>
                        <th scope="col">Depart</th>
                        <th scope="col">Duree</th>

                    </thead>
                    <tbody>
                        <?php foreach ($rapportp as $i => $product) { ?>
                        <tr>
                            <th scope="row"><?php echo $i + 1 ?></th>
                            <td><?php echo $product['nom'].' '.$product['postnom'] ?></td>
                            <td><?php echo $product['grade'] ?></td>
                            <td><?php echo $product['arrive'] ?></td>
                            <td><?php echo $product['depart'] ?></td>
                            <td><?php echo timeduiff($product['depart'], $product['arrive'])?></td>

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