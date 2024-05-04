<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        button a{
            text-decoration : none;
            color:white;
        }
    </style>
</head>
<body data-bs-theme="dark">
    <?php include 'include/nav.php'?>
    <div class="container" style=" padding : 5% 0%" >
        <div class="d-grid gap-2 d-md-block">
            <button type="button" class="btn btn-primary btn-lg"><a href="AjouterUtilisateur.php"><i class="fa-solid fa-user-plus"></i></a></button>
            <button class="btn btn-primary" type="button"><a href="#admin">Administrateurs</a></button>
            <button class="btn btn-primary" type="button"><a href="#chef">Chefs de département</a></button>
            <button class="btn btn-primary" type="button"><a href="#secretaire">Secretaires de département</a></button>
            <button class="btn btn-primary" type="button"><a href="#etudiant">Etudiants</a></button>
        </div>

        <!--la liste des admins-->
        <div id="admin" class="card shadow mb-4" style=" margin-top : 10px;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">La liste des administrateurs :</h6>
            </div>
            <div class="card-body" data-bs-theme="dark">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID_utilisateur</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Email</th>
                                <th>Mot de passe</th>
                                <th>Opérations</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID_utilisateur</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Email</th>
                                <th>Mot de passe</th>
                                <th>Opérations</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            require_once 'include/database.php';
                            $admins = $pdo -> query('SELECT U.ID_utilisateur, U.Nom, U.Prenom, U.Email,U.Mdp
                                                     FROM Utilisateurs U
                                                     JOIN Roles R ON U.ID_role = R.ID_role
                                                     WHERE R.Nom_role = "admin";')->fetchAll(PDO::FETCH_ASSOC);

                            foreach($admins as $admin){
                                ?>
                                    <tr>
                                        <td><?php echo $admin['ID_utilisateur']?></td>
                                        <td><?php echo $admin['Nom']?></td>
                                        <td><?php echo $admin['Prenom']?></td>
                                        <td><?php echo $admin['Email']?></td>
                                        <td><?php echo $admin['Mdp']?></td>
                                        <td >
                                            <a href="ModUtilisateur.php?ID_utilisateur=<?php echo $admin['ID_utilisateur']?>" style="margin-left:10%;"><i class="fa-solid fa-user-pen"></i></a >
                                            <a href="SupUtilisateur.php?ID_utilisateur=<?php echo $admin['ID_utilisateur']?>" style="margin-left:10px;" onclick="return confirm('Voulez-vous vraiment SUPPRIMER cet admin?');"><i class="fa-solid fa-user-xmark"></i></a >
                                        </td>
                                    </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--la liste des chefs-->
        <div id="chef" class="card shadow mb-4" style=" margin-top : 10px;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">La liste des chefs de département :</h6>
            </div>
            <div class="card-body" data-bs-theme="dark">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID_utilisateur</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Email</th>
                                <th>Mot de passe</th>
                                <th>Filière</th>
                                <th>Opérations</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID_utilisateur</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Email</th>
                                <th>Mot de passe</th>
                                <th>Filière</th>
                                <th>Opérations</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $chefs = $pdo -> query('SELECT U.ID_utilisateur,U.Nom, U.Prenom, U.Email, U.Mdp, F.Nom_filiere
                                                     FROM utilisateurs U
                                                     JOIN chefs_departement CD ON U.ID_utilisateur = CD.ID_utilisateur
                                                     JOIN filieres F ON CD.ID_filiere = F.ID_filiere;')->fetchAll(PDO::FETCH_ASSOC);

                            foreach($chefs  as $chef){
                                ?>
                                    <tr>
                                        <td><?php echo $chef['ID_utilisateur']?></td>
                                        <td><?php echo $chef['Nom']?></td>
                                        <td><?php echo $chef['Prenom']?></td>
                                        <td><?php echo $chef['Email']?></td>
                                        <td><?php echo $chef['Mdp']?></td>
                                        <td><?php echo $chef['Nom_filiere']?></td>
                                        <td >
                                            <a href="ModUtilisateur.php?ID_utilisateur=<?php echo $chef['ID_utilisateur']?>" style="margin-left:10%;"><i class="fa-solid fa-user-pen"></i></a >
                                            <a href="SupUtilisateur.php?ID_utilisateur=<?php echo $chef['ID_utilisateur']?>" style="margin-left:10px;" onclick="return confirm('Voulez-vous vraiment SUPPRIMER cet admin?');"><i class="fa-solid fa-user-xmark"></i></a >
                                        </td>
                                    </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--la liste des secretaires-->
        <div id="secretaire" class="card shadow mb-4" style=" margin-top : 10px;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">La liste des secretaires de département :</h6>
            </div>
            <div class="card-body" data-bs-theme="dark">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID_utilisateur</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Email</th>
                                <th>Mot de passe</th>
                                <th>Filière</th>
                                <th>Opérations</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID_utilisateur</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Email</th>
                                <th>Mot de passe</th>
                                <th>Filière</th>
                                <th>Opérations</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        <?php
                        $secretaires = $pdo -> query('SELECT U.ID_utilisateur,U.Nom, U.Prenom, U.Email, U.Mdp, F.Nom_filiere
                                                     FROM utilisateurs U
                                                     JOIN secretaires_departement SD ON U.ID_utilisateur = SD.ID_utilisateur
                                                     JOIN filieres F ON SD.ID_filiere = F.ID_filiere;')->fetchAll(PDO::FETCH_ASSOC);

                            foreach($secretaires  as $secretaire){
                                ?>
                                    <tr>
                                        <td><?php echo $secretaire['ID_utilisateur']?></td>
                                        <td><?php echo $secretaire['Nom']?></td>
                                        <td><?php echo $secretaire['Prenom']?></td>
                                        <td><?php echo $secretaire['Email']?></td>
                                        <td><?php echo $secretaire['Mdp']?></td>
                                        <td><?php echo $secretaire['Nom_filiere']?></td>
                                        <td >
                                            <a href="ModUtilisateur.php?ID_utilisateur=<?php echo $secretaire['ID_utilisateur']?>" style="margin-left:10%;"><i class="fa-solid fa-user-pen"></i></a >
                                            <a href="SupUtilisateur.php?ID_utilisateur=<?php echo $secretaire['ID_utilisateur']?>" style="margin-left:10px;" onclick="return confirm('Voulez-vous vraiment SUPPRIMER cette secretaire de département?');"><i class="fa-solid fa-user-xmark"></i></a >
                                        </td>
                                    </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>   

        <!--la liste des etudiants-->
        <div id="etudiant" class="card shadow mb-4" style=" margin-top : 10px;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">La liste des étudiants :</h6>
            </div>
            <div class="card-body" data-bs-theme="dark">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID_utilisateur</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Email</th>
                                <th>Mot de passe</th>
                                <th>Filière</th>
                                <th>Niveau</th>
                                <th>Opérations</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID_utilisateur</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Email</th>
                                <th>Mot de passe</th>
                                <th>Filière</th>
                                <th>Niveau</th>
                                <th>Opérations</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $etudiants = $pdo -> query('SELECT U.ID_utilisateur, U.Nom, U.Prenom, U.Email ,U.Mdp, F.Nom_filiere, N.Nom_niveau
                                                    FROM utilisateurs U
                                                    JOIN etudiant E ON U.ID_utilisateur = E.ID_utilisateur
                                                    JOIN filieres F ON E.ID_filiere = F.ID_filiere
                                                    JOIN niveaux N ON E.ID_niveau = N.ID_niveau;')->fetchAll(PDO::FETCH_ASSOC);

                            foreach($etudiants as $etudiant){
                                ?>
                                    <tr>
                                        <td><?php echo $etudiant['ID_utilisateur']?></td>
                                        <td><?php echo $etudiant['Nom']?></td>
                                        <td><?php echo $etudiant['Prenom']?></td>
                                        <td><?php echo $etudiant['Email']?></td>
                                        <td><?php echo $etudiant['Mdp']?></td>
                                        <td><?php echo $etudiant['Nom_filiere']?></td>
                                        <td><?php echo $etudiant['Nom_niveau']?></td>
                                        <td >
                                            <a href="ModUtilisateur.php?ID_utilisateur=<?php echo $etudiant['ID_utilisateur']?>" style="margin-left:10%;"><i class="fa-solid fa-user-pen"></i></a >
                                            <a href="SupUtilisateur.php?ID_utilisateur=<?php echo $etudiant['ID_utilisateur']?>" style="margin-left:10px;" onclick="return confirm('Voulez-vous vraiment SUPPRIMER cet etudiant?');"><i class="fa-solid fa-user-xmark"></i></a >
                                        </td>
                                    </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>        
    </div>  
    
</body>
</html>