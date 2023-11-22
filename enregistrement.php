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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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

                <!--Display Error-->
                <?php if(isset($_GET['error'])) : ?>
                <div class="error"><?php echo $_GET['error']; ?></div>
                <?php endif; ?>

                <!--Form-->
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
        <div class="heading">
            <h3>Liste des Agents</h3>
        </div>
        <div class="search-container">
            <input type="text" placeholder="Search...">
            <button type="submit">Search</button>
        </div>

        <div class="container1 flex-container">
            <div id="table-box">
                <table class="table">
                    <thead>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Postnom</th>
                        <th scope="col">Prenom</th>
                        <th scope="col">Sexe</th>
                        <th scope="col">Matricule</th>
                        <th scope="col">Grade</th>

                    </thead>
                    <tbody>
                        <?php foreach (list_agent($con) as $i => $product) { ?>
                        <tr>
                            <th scope="row"><?php echo $i + 1 ?></th>
                            <td><?php echo $product['nom'] ?></td>
                            <td><?php echo $product['postnom'] ?></td>
                            <td><?php echo 'Unknown' ?></td>
                            <td><?php echo ' ' ?></td>
                            <td><?php echo $product['matricule'] ?></td>
                            <td><?php echo $product['grade'] ?></td>


                        </tr>

                        <?php } ?>
                    </tbody>

                </table><br><br>
            </div>

        </div>

        </div>
    </section>

    <?php include_once 'footer.php'; ?>
</body>

</html>