<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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

    <div class="container" style=" padding : 2% 0%" >
    <?php
    // Vérifier si le formulaire a été soumis
    if (isset($_POST['Deposer'])) {
        // Inclure le fichier de configuration de la base de données
        require_once 'include/database.php';

        // Récupérer les données du formulaire
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $fichier = $_FILES['fichier'];
    
        // Gérer le fichier uploadé
        $uploadDir = 'uploads/'; // Répertoire de stockage des fichiers
        $uploadFile = $uploadDir . basename($fichier['name']); // Chemin complet du fichier uploadé

        // Déplacer le fichier téléchargé vers le répertoire de destination
        if (move_uploaded_file($fichier['tmp_name'], $uploadFile)) {
            // Insertion des données dans la table rapports_stage
            $sql = "INSERT INTO rapports_stage (Titre_rapport, Description_rapport, Chemin_fichier, Date_depot) VALUES (?, ?, ?, NOW())";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$titre, $description, $uploadFile]);
            $rapportId = $pdo->lastInsertId(); // Récupérer l'ID du rapport inséré

            // Récupérer les ID des étudiants sélectionnés
            $etudiants = $_POST['etudiants'];

            // Ajouter les liens entre les rapports et les étudiants dans la table rapports_etudiants
            foreach ($etudiants as $etudiantId) {
                $sql = "INSERT INTO rapports_etudiants (ID_rapport, ID_etudiant) VALUES (?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$rapportId, $etudiantId]);
            }

            echo '<div class="alert alert-success" role="alert">Le rapport a été soumis avec succès!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Une erreur s\'est produite lors du téléchargement du fichier.</div>';
        }
    }
    ?>
        <h1>Dépôt de Rapport</h1>
        <form action="depotRapport.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="titre" class="form-label">Titre du rapport</label>
                <input type="text" class="form-control" id="titre" name="titre" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description du rapport</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="fichier" class="form-label">Fichier du rapport</label>
                <input type="file" class="form-control" id="fichier" name="fichier" required>
            </div>
            <!-- Ajoutez ici la sélection des étudiants qui ont contribué au rapport -->
            <!-- Exemple: -->
            <div class="mb-3 d-grid gap-2 d-md-block">
                <div class="row align-items-center">
                    <label for="etudiants" class="form-label col-md-4">Étudiants qui ont contribué au rapport</label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input id="myInput" type="text" placeholder="Entrez le nom de l'étudiant rechercher..." class="form-control rounded" aria-label="Search" aria-describedby="search-addon" style="margin-bottom: 10px;" />
                            <span class="input-group-text border-0" id="search-addon" style="margin-bottom: 10px;">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <select id="select" multiple class="form-select" id="etudiants" name="etudiants[]" required>
                    <?php
                    require_once 'include/database.php';
                    // Requête pour récupérer la liste des étudiants depuis la base de données
                    $etudiants = $pdo -> query('SELECT E.ID_etudiant, U.Nom, U.Prenom
                                                    FROM utilisateurs U
                                                    JOIN etudiant E ON U.ID_utilisateur = E.ID_utilisateur
                                                    JOIN filieres F ON E.ID_filiere = F.ID_filiere
                                                    JOIN niveaux N ON E.ID_niveau = N.ID_niveau
                                                    ORDER BY E.ID_filiere;')->fetchAll(PDO::FETCH_ASSOC);

                    foreach($etudiants as $etudiant){

                        ?>
                        <option  value="<?php echo $etudiant['ID_etudiant'] ?>"><?php echo  strtoupper($etudiant['Nom']) . ' ' .  ucwords($etudiant['Prenom'] )?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-12">
            <button class="btn btn-primary" type="submit" name="Deposer">Déposer le rapport</button>
            </div>
        </form>
    </div>


    <script>
        $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#select option").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        });
    </script>
</body>
</html>

