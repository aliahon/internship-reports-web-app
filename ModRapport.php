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

    $sqlState = $pdo->prepare('SELECT *
                              FROM rapports_stage
                              WHERE ID_rapport=?;');
    $sqlState -> execute([$id]);
    $rapport = $sqlState ->fetchAll(PDO::FETCH_ASSOC);

    $sqlStat = $pdo->prepare('SELECT U.ID_utilisateur, U.Nom, U.Prenom, U.Email,U.Mdp, U.ID_role, R.Nom_role
                              FROM etudiant E
                              JOIN rapport R ON U.ID_role = R.ID_role
                              WHERE U.ID_utilisateur=?;');
    $sqlStat -> execute([$id]);
    $etudiant = $sqlStat ->fetchAll(PDO::FETCH_ASSOC);
    // Check if the form was submitted
    if (isset($_POST['Modifier'])) {

        // Retrieve form data
        $rapportId = $_POST['rapportId'];
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $fichier = $_FILES['fichier'];
    
        // Handle uploaded file
        $uploadDir = 'uploads/'; // Directory to store files
        $uploadFile = $uploadDir . basename($fichier['name']); // Full path of the uploaded file

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($fichier['tmp_name'], $uploadFile)) {
            // Update data in the rapports_stage table
            $sql = "UPDATE rapports_stage SET Titre_rapport = ?, Description_rapport = ?, Chemin_fichier = ? WHERE ID_rapport = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$titre, $description, $uploadFile, $rapportId]);

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
        <form action="modifyRapport.php" method="POST" enctype="multipart/form-data">
            <!-- Hidden input field to store the rapport ID -->
            <input type="hidden" name="rapportId" value="<?php echo $rapportId; ?>">
            <div class="mb-3">
                <label for="titre" class="form-label">Titre du rapport</label>
                <input type="text" class="form-control" id="titre" name="titre" value="<?php echo $titre; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description du rapport</label>
                <textarea class="form-control" id="description" name="description" required><?php echo $description; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="fichier" class="form-label">Fichier du rapport</label>
                <input type="file" class="form-control" id="fichier" name="fichier">
            </div>
            <!-- Selection of students contributing to the report -->
            <!-- Example: -->
            <div class="mb-3 d-grid gap-2 d-md-block">
                <!-- Modify as needed -->
            </div>
            <div class="col-12">
            <button class="btn btn-primary" type="submit" name="Modifier">Modifier le rapport</button>
            </div>
        </form>
    </div>


    <script>
        $(document).ready(function(){
        // Add any client-side script if needed
        });
    </script>
</body>
</html>
