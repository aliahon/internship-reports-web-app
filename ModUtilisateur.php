<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body data-bs-theme="dark">
    <?php include 'include/nav.php'?>
    <?php include 'include/securité.php' ?>
    <div class="container" style=" padding : 5% 10%" >
        <?php
            require_once 'include/database.php';
            $id = $_GET['ID_utilisateur'];  
            
            $sqlStat = $pdo->prepare('SELECT U.ID_utilisateur, U.Nom, U.Prenom, U.Email,U.Mdp, U.ID_role, R.Nom_role
                                     FROM utilisateurs U
                                     JOIN roles R ON U.ID_role = R.ID_role
                                     WHERE U.ID_utilisateur=?;');
            $sqlStat -> execute([$id]);
            $utilisateur = $sqlStat ->fetchAll(PDO::FETCH_ASSOC);
            $role = $utilisateur[0]['ID_role'];
            $nomRole = $utilisateur[0]['Nom_role'];
            $idFiliere = 1;
            $filiere = "admin";
            $idNiveau = 1;
            $niveau = "1ére année cycle d'ingénieur";
            if(! isset($_POST['Modifier'])){
                switch ($role){
                    case 2 : 
                        $sql= $pdo -> prepare('SELECT F.ID_filiere, F.Nom_filiere
                                              FROM utilisateurs U
                                              JOIN chefs_departement CD ON U.ID_utilisateur = CD.ID_utilisateur
                                              JOIN filieres F ON CD.ID_filiere = F.ID_filiere
                                              WHERE U.ID_utilisateur=?;');
                        
                        $sql->execute([$id]);
                        $chef = $sql->fetchAll(PDO::FETCH_ASSOC);
                        $idFiliere = $chef[0]['ID_filiere'];
                        $filiere = $chef[0]['Nom_filiere'];
                        $idNiveau = 1;
                        $niveau = "1ére année cycle d'ingénieur";
                        break;
                
                    case 3 : 
                        $sql = $pdo -> prepare('SELECT F.ID_filiere, F.Nom_filiere
                                                      FROM utilisateurs U
                                                      JOIN secretaires_departement SD ON U.ID_utilisateur = SD.ID_utilisateur
                                                      JOIN filieres F ON SD.ID_filiere = F.ID_filiere
                                                      WHERE U.ID_utilisateur=?;');
                        $sql->execute([$id]);
                        $secretaire = $sql->fetchAll(PDO::FETCH_ASSOC);
                        var_dump($secretaire);
                        $idFiliere = $secretaire[0]['ID_filiere'];
                        $filiere = $secretaire[0]['Nom_filiere'];
                        $idNiveau = 1;
                        $niveau = "1ére année cycle d'ingénieur";
                        break;
                            
                    case 4 : 
                        $sql = $pdo -> prepare('SELECT F.ID_filiere, F.Nom_filiere, N.ID_niveau, N.Nom_niveau
                                              FROM utilisateurs U
                                              JOIN etudiant E ON U.ID_utilisateur = E.ID_utilisateur
                                              JOIN filieres F ON E.ID_filiere = F.ID_filiere
                                              JOIN niveaux N ON E.ID_niveau = N.ID_niveau
                                              WHERE U.ID_utilisateur=?;');
                        $sql->execute([$id]);
                        $etudiant = $sql->fetchAll(PDO::FETCH_ASSOC);
                        $idFiliere = $etudiant[0]['ID_filiere'];
                        $filiere = $etudiant[0]['Nom_filiere'];
                        $idNiveau = $etudiant[0]['ID_niveau'];
                        $niveau = $etudiant[0]['Nom_niveau'];
                        break;
                }
    
            }
            //Modification
            /*
            if(isset($_POST['Modifier'])){
                $Nom = $_POST['Nom'];
                $Prenom = $_POST['Prenom'];
                $Email = $_POST['Email'];
                $mdp = $_POST['Mot_de_passe'];
                $ID_role = $_POST['ID_role']; //fixe pour le moment

                if(!empty($Nom) && !empty($Prenom) && !empty($Email) && !empty($mdp) && !empty($ID_role)){
                    $sqlState = $pdo -> prepare('UPDATE utilisateurs 
                                                SET Nom = ? , Prenom = ?, Email=?, Mdp = ?, ID_role = ?
                                                WHERE ID_utilisateur = ?');
                    $mod=$sqlState -> execute([$Nom,$Prenom,$Email,$mdp, $ID_role, $id]);

                    switch ($ID_role){
                        case 2 : 
                            $ID_filiere = $_POST['ID_filiere'];
                            $sqlState = $pdo -> prepare('UPDATE chefs_departement 
                                                        SET ID_filiere = ?
                                                        WHERE ID_utilisateur = ?');
                            $mod=$sqlState -> execute([$ID_filiere, $id]);
                            break;
    
                        case 3 : 
                            $ID_filiere = $_POST['ID_filiere'];
                            $sqlState = $pdo -> prepare('UPDATE secretaires_departement
                                                        SET ID_filiere = ?
                                                        WHERE ID_utilisateur = ?');
                            $mod=$sqlState -> execute([$ID_filiere, $id]);
                            break;
                                
                        case 4 : 
                            $ID_filiere = $_POST['ID_filiere'];
                            $ID_niveau = $_POST['ID_niveau'];
                            $sqlState = $pdo -> prepare('UPDATE utilisateurs 
                                                        SET ID_filiere = ?, ID_niveau = ?
                                                        WHERE ID_utilisateur = ?');
                            $mod=$sqlState -> execute([$ID_filiere, $ID_niveau, $id]);
                            break;
                    }


                    if($mod){
                        ?>
                        <div class="alert alert-success" role="alert">
                            L'utilisateur a été bien modifié!
                        </div>
                        <?php
                    }
                    else{
                        ?>
                        <div  class="alert alert-danger" role="alert">
                            Erreur : L'utilisateur n'a pas été correctement modifié. Veuillez réessayer.
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
            }*/

            //Modification
            if(isset($_POST['Modifier'])){
                $Nom = $_POST['Nom'];
                $Prenom = $_POST['Prenom'];
                $Email = $_POST['Email'];
                $mdp = $_POST['Mot_de_passe'];
                $ID_role = $_POST['ID_role'];
                $Ancien_role = $_POST['Ancien_role'];

                if(!empty($Nom) && !empty($Prenom) && !empty($Email) && !empty($mdp) && !empty($ID_role)){
                    // Mettre à jour les informations de l'utilisateur
                    $sqlState = $pdo->prepare('UPDATE utilisateurs 
                                            SET Nom = ?, Prenom = ?, Email=?, Mdp = ?, ID_role = ?
                                            WHERE ID_utilisateur = ?');
                    $mod = $sqlState->execute([$Nom, $Prenom, $Email, $mdp, $ID_role, $id]);

                    if ($mod) {
                        // Si le rôle a changé, effectuer les opérations de mise à jour des tables de rôles
                        if ($ID_role != $Ancien_role) {
                            // Supprimer l'entrée correspondante dans la table de l'ancien rôle
                            switch ($Ancien_role) {
                                case 2:
                                    $sqlDelete = $pdo->prepare('DELETE FROM chefs_departement WHERE ID_utilisateur = ?');
                                    $sqlDelete->execute([$id]);
                                    break;
                                case 3:
                                    $sqlDelete = $pdo->prepare('DELETE FROM secretaires_departement WHERE ID_utilisateur = ?');
                                    $sqlDelete->execute([$id]);
                                    break;
                                case 4:
                                    $sqlDelete = $pdo->prepare('DELETE FROM etudiant WHERE ID_utilisateur = ?');
                                    $sqlDelete->execute([$id]);
                                    break;
                                // Ajoutez d'autres cas si nécessaire
                            }

                            // Insérer les nouvelles informations dans la table correspondant au nouveau rôle
                            switch ($ID_role) {
                                case 2:
                                    $ID_filiere = $_POST['ID_filiere'];
                                    $sqlInsert = $pdo->prepare('INSERT INTO chefs_departement (ID_utilisateur, ID_filiere) VALUES (?, ?)');
                                    $sqlInsert->execute([$id, $ID_filiere]);
                                    break;
                                case 3:
                                    $ID_filiere = $_POST['ID_filiere'];
                                    $sqlInsert = $pdo->prepare('INSERT INTO secretaires_departement (ID_utilisateur, ID_filiere) VALUES (?, ?)');
                                    $sqlInsert->execute([$id, $ID_filiere]);
                                    break;
                                case 4:
                                    $ID_filiere = $_POST['ID_filiere'];
                                    $ID_niveau = $_POST['ID_niveau'];
                                    $sqlInsert = $pdo->prepare('INSERT INTO etudiant (ID_utilisateur, ID_filiere, ID_niveau) VALUES (?, ?, ?)');
                                    $sqlInsert->execute([$id, $ID_filiere, $ID_niveau]);
                                    break;
                            }
                        }
                        else{
                            //Update if the old role is the same as the new one
                            switch ($ID_role){
                                case 2 : 
                                    $ID_filiere = $_SESSION['utilisateur']['ID_filiere'];
                                    $sqlState = $pdo -> prepare('UPDATE chefs_departement 
                                                                SET ID_filiere = ?
                                                                WHERE ID_utilisateur = ?');
                                    $mod=$sqlState -> execute([$ID_filiere, $id]);
                                    break;
            
                                case 3 : 
                                    $ID_filiere = $_SESSION['utilisateur']['ID_filiere'];
                                    $sqlState = $pdo -> prepare('UPDATE secretaires_departement
                                                                SET ID_filiere = ?
                                                                WHERE ID_utilisateur = ?');
                                    $mod=$sqlState -> execute([$ID_filiere, $id]);
                                    break;
                                        
                                case 4 : 
                                    $ID_filiere = $_SESSION['utilisateur']['ID_filiere'];
                                    $ID_niveau = $_SESSION['utilisateur']['ID_niveau'];
                                    $sqlState = $pdo -> prepare('UPDATE utilisateurs 
                                                                SET ID_filiere = ?, ID_niveau = ?
                                                                WHERE ID_utilisateur = ?');
                                    $mod=$sqlState -> execute([$ID_filiere, $ID_niveau, $id]);
                                    break;
                            }
                        }

                        ?>
                                <div class="alert alert-success" role="alert">
                                    L'utilisateur a été bien modifié!
                                </div>
                        <?php
                            } else {
                                ?>
                                <div  class="alert alert-danger" role="alert">
                                    Erreur : L'utilisateur n'a pas été correctement modifié. Veuillez réessayer.
                                </div>
                                <?php
                            }
                        } else { 
                            ?>
                            <div class="alert alert-danger" role="alert">
                                Tous les champs sont obligatoires!
                            </div>
                            <?php
                        }
                    }
        ?>
        <div style="display: flex; justify-content: space-between;">
            <h4 >Modifier Utilisateur!</h4>
            <form >
                <div class="col-12">
                    <button type="button" class="btn btn-primary btn-lg"><a href="utilisateur.php"><i class="fa-solid fa-arrow-right"></i></a></button>
                </div>
            </form>
        </div>

        <form class="row g-3 needs-validation" method="post" novalidate>
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Nom</label>
                <input type="text" class="form-control" id="validationCustom01" name="Nom" value="<?php echo $utilisateur[0]['Nom']; ?>" required>
                <div class="valid-feedback">
                Looks good!
                </div>
            </div>
            <div class="col-md-4">
                <label for="validationCustom02" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="validationCustom02" name="Prenom" value="<?php echo $utilisateur[0]['Prenom']; ?>" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-5">
                <label for="validationCustom03" class="form-label">Email</label>
                <input type="email" class="form-control" id="validationCustom03" name="Email" value="<?php echo $utilisateur[0]['Email']; ?>" required>
                <div class="invalid-feedback">
                    Please provide a valid Email.
                </div>
            </div>
            <div class="col-md-3">
                <label for="validationCustom04" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="validationCustom04" name="Mot de passe" value="<?php echo $utilisateur[0]['Mdp'] ;?>" required>
                <div class="invalid-feedback">
                Please provide a valid Password.
                </div>
            </div>
            <input type="hidden" name="Ancien_role" value="<?php echo $role; ?>">
            <div class="col-md-3 ">
                <label for="validationCustom05" class="form-label">Role</label>
                <select class="form-select" id="validationCustom05" name="ID_role"  required>
                <option value="<?php echo $role ;?>" selected><?php echo $nomRole ;?></option>
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
                <button class="btn btn-primary" type="submit" name="Modifier">Modifier Utilisateur</button>
            </div>
        </form>

    </div>

    <script>
        document.getElementById('validationCustom05').addEventListener('change', function() {
            var roleId = this.value;
            if (roleId == 2 || roleId == 3 ) {
                fetch(`chefMod.php?id=${encodeURIComponent('<?php echo $idFiliere;?>')}&filiere=${encodeURIComponent('<?php echo $filiere;?>')}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('myContainer').innerHTML = data;
                });
            } else if(roleId == 4){
                fetch('etudiantMod.php?idFiliere=<?php echo $idFiliere ;?>&filiere=<?php echo $filiere ;?>&idNiveau=<?php echo $idNiveau ;?>&niveau=<?php echo $niveau ;?>')
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

