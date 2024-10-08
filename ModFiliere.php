<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>filieres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body data-bs-theme="dark">
    <?php include 'include/nav.php'?>
    <div class="container" style=" padding : 5% 10%" >
        <?php
            require_once 'include/database.php';
            $id = $_GET['ID_filiere_'];

            $sqlStat = $pdo->prepare('SELECT * FROM filieres WHERE ID_filiere=?');
            $sqlStat -> execute([$id]);
            $filiere = $sqlStat ->fetchAll(PDO::FETCH_ASSOC);

            if(isset($_POST['Modifier'])){
                $Nom = $_POST['Nom'];

                if(!empty($Nom)){
                    $sqlState = $pdo -> prepare('UPDATE filieres SET Nom_filiere = ? WHERE ID_filiere = ?');
                    $mod=$sqlState -> execute([$Nom, $id]);
                    if($mod){
                        ?>
                        <div class="alert alert-success" role="alert">
                            La filière <?php echo $Nom?> a été bien modifié!
                        </div>
                        <?php
                    }
                    else{
                        ?>
                        <div  class="alert alert-danger" role="alert">
                            Erreur : La filière <?php echo $Nom?> n'a pas été correctement modifié. Veuillez réessayer.
                        </div>
                        <?php
                    }
                }
                else { 
                    ?>
                    <div class="alert alert-danger" role="alert">
                        Tous les champs sont obligatoires!
                    </div>
                    <?php
                }
            }

        ?>
        <div style="display: flex; justify-content: space-between;">
            <h4>Modifier une Filière!</h4>
            <form >
                <div class="col-12">
                    <button type="button" class="btn btn-primary btn-lg"><a href="filiere.php"><i class="fa-solid fa-arrow-right"></i></a></button>
                </div>
            </form>
        </div>
        
        <form class="row g-3 needs-validation" method="post" novalidate>
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Nom de la filière</label>
                <input type="text" class="form-control" id="validationCustom01" name="Nom" value="<?php echo $filiere[0]['Nom_filiere']; ?>" required>
                <div class="valid-feedback">
                Looks good!
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit" name="Modifier">Modifier Filière</button>
            </div>
        </form>
    </div>
</body>
</html>