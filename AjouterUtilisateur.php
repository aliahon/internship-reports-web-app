<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body data-bs-theme="dark">
    <?php include 'include/nav.php'?>
    <?php include 'include/securité.php' ?>
    <div class="container" style=" padding : 5% 10%" >
        <?php
            if(isset($_POST['Ajouter'])){
                $Nom = $_POST['Nom'];
                $Prenom = $_POST['Prenom'];
                $Email = $_POST['Email'];
                $mdp = $_POST['Mot_de_passe'];
                $ID_role = $_POST['ID_role'];

                if(!empty($Nom) && !empty($Prenom) && !empty($Email) && !empty($mdp) && !empty($ID_role)){
                    require_once 'include/database.php';
                    $sqlState = $pdo -> prepare('INSERT INTO utilisateurs VALUES(null, ?,?,?,?,?)');
                    $ajout = $sqlState -> execute([$Nom,$Prenom, $Email,$mdp, $ID_role]);


                    //ajouter aux autre tableaux selon le role d'utilisateur
                    $sqlStat = $pdo -> prepare('SELECT * FROM utilisateurs WHERE Email = ? AND Mdp = ?');
                    $sqlStat -> execute([$Email, $mdp]);
                    $utilisateur=$sqlStat->fetchAll(PDO::FETCH_ASSOC);
                    $role = $utilisateur[0]['ID_role'];
                    $id = $utilisateur[0]['ID_utilisateur'];
                    switch ($role){
                        case 2 : 
                            $ID_filiere = $_POST['ID_filiere'];
                            if(!empty($ID_filiere)){

                                $sqlState = $pdo -> prepare('INSERT INTO chefs_departement VALUES(null, ?,?)');
                                $ajout = $sqlState -> execute([$id, $ID_filiere]);
                            }
                            else { 
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    Tous les champs sont obligatoires!
                                </div>
                                <?php
                            }
                            break;
    
                        case 3 : 
                            $ID_filiere = $_POST['ID_filiere'];
                            if(!empty($ID_filiere)){

                                $sqlState = $pdo -> prepare('INSERT INTO secretaires_departement VALUES(null, ?,?)');
                                $ajout = $sqlState -> execute([$id, $ID_filiere]);
                            }
                            else { 
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    Tous les champs sont obligatoires!
                                </div>
                                <?php
                            }
                            break;
                                
                        case 4 : 
                            $ID_filiere = $_POST['ID_filiere'];
                            $ID_niveau = $_POST['ID_niveau'];
                            if(!empty($ID_filiere) || !empty($ID_niveaue)){

                                $sqlState = $pdo -> prepare('INSERT INTO etudiant VALUES(null, ?,?,?)');
                                $ajout = $sqlState -> execute([$id, $ID_filiere, $ID_niveau]);
                            }
                            else { 
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    Tous les champs sont obligatoires!
                                </div>
                                <?php
                            }
                            break;
                    }
                    if($ajout){
                        ?>
                        <div class="alert alert-success" role="alert">
                            L'utilisateur a été bien ajouté!
                        </div>
                        <?php
                    }
                    else{
                        ?>
                        <div  class="alert alert-danger" role="alert">
                            Erreur :  L'utilisateur n'a pas été correctement ajouté. Veuillez réessayer.
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
            <h4 >Ajouter un Utilisateur!</h4>
            <form >
                <div class="col-12">
                    <button type="button" class="btn btn-primary btn-lg"><a href="utilisateur.php"><i class="fa-solid fa-arrow-right"></i></a></button>
                </div>
            </form>
        </div>

        <form class="row g-3 needs-validation" method="post" novalidate>
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Nom</label>
                <input type="text" class="form-control" id="validationCustom01" name="Nom" required>
                <div class="valid-feedback">
                Looks good!
                </div>
            </div>
            <div class="col-md-4">
                <label for="validationCustom02" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="validationCustom02" name="Prenom" required>
                <div class="valid-feedback">
                Looks good!
                </div>
            </div>
            <div class="col-md-5">
                <label for="validationCustom03" class="form-label">Email</label>
                <input type="email" class="form-control" id="validationCustom03" name="Email" placeholder="ex: nom.prenom@edu.uiz.ac.ma" required>
                <div class="invalid-feedback">
                Please provide a valid Email.
                </div>
            </div>
            <div class="col-md-3">
                <label for="validationCustom04" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="validationCustom04" name="Mot de passe" required>
                <div class="invalid-feedback">
                Please provide a valid Password.
                </div>
            </div>
            <div class="col-md-3 ">
                <label for="validationCustom05" class="form-label">Role</label>
                <select class="form-select" id="validationCustom05" name="ID_role" required>
                <option value="1">Admin</option>
                <option value="2">Chef de département</option>
                <option value="3">Secretaire de département</option>
                <option value="4">Etudiant</option>
                </select>
                <div class="invalid-feedback">
                Please select a valid Role.
                </div>
            </div>
            <div id="myContainer"></div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit" name="Ajouter">Ajouter Utilisateur</button>
            </div>
        </form>

    </div>

    <script>
        document.getElementById('validationCustom05').addEventListener('change', function() {
            var roleId = this.value;
            if (roleId == 2 || roleId == 3 ) {
                fetch('chef.php')
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('myContainer').innerHTML = data;
                    });
            } else if(roleId == 4){
                fetch('etudiant.php')
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('myContainer').innerHTML = data;
                    });
            }
            else {
                document.getElementById('myContainer').innerHTML = ''; 
            }
        });
    </script>
    
</body>
</html>

