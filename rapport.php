<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport</title>
</head>
<body>
     <!--Header-->
     <?php include_once 'header.php'; ?>
     <!--Sub Header -->
<div class="sub-header">
  <p class="left-title">Rapport</p>

  <div id="rigth-title">
      <p class="left-title"> Total : <?php echo 15//$rs_count['total_agent'];?></p>
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
                            <input type="text" name="matricule" placeholder="Inserer votre Matricule" id="input1">
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
                        <th scope="col">Nom et Postnom</th>
                        <th scope="col">Grade</th>
                        <th scope="col">Arrive</th>
                        <th scope="col">Depart</th>

                    </thead>
                    <tbody>
                        <?php foreach (liste_presence($con) as $i => $product) { ?>
                        <tr>
                            <th scope="row"><?php echo $i + 1 ?></th>
                            <td><?php echo $product['nom'].' '.$product['postnom'] ?></td>
                            <td><?php echo $product['grade'] ?></td>
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