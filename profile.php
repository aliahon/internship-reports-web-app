<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body data-bs-theme="dark">
    <?php include 'include/nav.php'?>
    <?php include 'include/securité.php' ?>
    <?php 
        require_once 'include/database.php';
        $idRole = $_SESSION['utilisateur']['ID_role'];
        $sqlRole = $pdo -> prepare('SELECT Nom_role FROM roles WHERE  ID_role = ? ');
        $sqlRole -> execute([$idRole]);
        $Role = $sqlRole -> fetch();
    ?>
    <section  data-bs-theme="dark">
        <div class="container py-5">
            <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="https://i.pinimg.com/236x/ad/73/1c/ad731cd0da0641bb16090f25778ef0fd.jpg" alt="avatar"
                        class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-3">N.E</h5>
                        <p class="text-muted mb-1"><?php echo $Role['Nom_role']; ?></p>
                        <div class="d-flex justify-content-center mb-2">
                            <form method="post" action="deconnexion.php">
                                <input type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary" value="Se déconnecter" name='deconnecter' onclick="return confirm('Voulez-vous vraiment vous déconnecter ?');">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Le nom complet</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0"><?php echo strtoupper($_SESSION['utilisateur']['Nom'] ). " " . ucwords($_SESSION['utilisateur']['Prenom']); ?></p>
                    </div>
                    </div>
                    <hr>
                    <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Email</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0"><?php echo $_SESSION['utilisateur']['Email']?></p>
                    </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Filière</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?php //l'extraction de Filière sera faite ici ?></p>
                        </div>
                    </div>
                    <?php 
                    if($_SESSION['utilisateur']['ID_role'] == 4){
                        ?>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Niveau</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"> 1ére anneé cycle d'ingénieur<?php //l'extraction de Niveau sera faite ici ?></p>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </div>
                </div>
            </div>
            </div>
        </div>
    </section>
</body>
</html>