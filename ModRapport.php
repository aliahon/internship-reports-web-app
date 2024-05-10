<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Rapport!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body data-bs-theme="dark">
<?php include 'include/nav.php'?>
    <?php include 'include/securité.php' ?>

    <div class="container" style=" padding : 2% 0%" >
    <?php
    require_once 'include/database.php';
    $id = $_GET['id']; 

    $sqlState = $pdo->prepare('SELECT ID_rapport, Titre_rapport, Description_rapport, Date_depot, Chemin_fichier
                              FROM rapports_stage
                              WHERE ID_rapport=?;');
    $sqlState -> execute([$id]);
    $rapport = $sqlState ->fetchAll(PDO::FETCH_ASSOC);
    var_dump($rapport);

    $sqlStat = $pdo->prepare('SELECT ID_etudiant
                              FROM rapports_etudiants 
                              WHERE ID_rapport=?;');
    $sqlStat -> execute([$id]);
    $contriEtudiant = $sqlStat ->fetchAll(PDO::FETCH_ASSOC);
    // Check if the form was submitted
    if (isset($_POST['Modifier'])) {

        // Retrieve form data
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $fichier = $_FILES['fichier'];

        $uploadDir = 'uploads/'; // Répertoire de stockage des fichiers
        $uploadFile = $uploadDir . basename($fichier['name']); // Chemin complet du fichier uploadé

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($fichier['tmp_name'], $uploadFile)) {
            // Update data in the rapports_stage table
            $sql = "UPDATE rapports_stage SET Titre_rapport = ?, Description_rapport = ?, Chemin_fichier = ? WHERE ID_rapport = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$titre, $description, $uploadFile, $id]);

            echo '<div class="alert alert-success" role="alert">Le rapport a été modifié avec succès!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Une erreur s\'est produite lors de la modification du fichier.</div>';
        }
    }
    ?>
        <div style="display: flex; justify-content: space-between;">
            <h4>Modifier Le Rapport!</h4>
            <form >
                <div class="col-12">
                    <button type="button" class="btn btn-primary btn-lg"><a href="rapport.php"><i class="fa-solid fa-arrow-right"></i></a></button>
                </div>
            </form>
        </div>
        <form  method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="titre" class="form-label">Titre du rapport</label>
                <input type="text" class="form-control" id="titre" name="titre" value="<?php echo $rapport[0]['Titre_rapport']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description du rapport</label>
                <textarea class="form-control" id="description" name="description" required><?php echo $rapport[0]['Description_rapport']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="fichier" class="form-label">Fichier du rapport</label>
                <input type="file" class="form-control" id="fichier" name="fichier" value="<?php echo $rapport[0]['Chemin_fichier']; ?>">
            </div>
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
                <select id="select" multiple class="form-select" name="etudiants[]" required>
                <?php
                $etudiants = $pdo -> query('SELECT E.ID_etudiant, U.Nom, U.Prenom, F.Nom_filiere, N.Nom_niveau
                                                    FROM utilisateurs U
                                                    JOIN etudiant E ON U.ID_utilisateur = E.ID_utilisateur
                                                    JOIN filieres F ON E.ID_filiere = F.ID_filiere
                                                    JOIN niveaux N ON E.ID_niveau = N.ID_niveau
                                                    ORDER BY E.ID_filiere;')->fetchAll(PDO::FETCH_ASSOC);

                    foreach($etudiants as $etudiant){
                        $isSelected = in_array($etudiant['ID_etudiant'], array_column($contriEtudiant, 'ID_etudiant'));
                        ?>
                        <option value="<?php echo $etudiant['ID_etudiant']; ?>" <?php echo $isSelected ? 'selected' : ''; ?>>
                            <?php echo strtoupper($etudiant['Nom']) . ' ' . ucwords($etudiant['Prenom']) . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $etudiant['Nom_filiere'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $etudiant['Nom_niveau']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-12">
            <button class="btn btn-primary" type="submit" name="Modifier">Modifier le rapport</button>
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
