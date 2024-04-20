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
    <div class="container" style=" padding : 5% 10%" >
        <?php
            if(isset($_POST['Ajouter'])){
                $Nom = $_POST['Nom'];
                $Prenom = $_POST['Prenom'];
                $Email = $_POST['Email'];
                $mdp = $_POST['Mot de passe'];
                $ID_role = $_POST['ID_role'];

                echo "$Nom    $Prenom  $Email $mdp   $ID_role";
            }

        ?>
        <h4 >Ajouter un Utilisateur!</h4>
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
                <input type="email" class="form-control" id="validationCustom03" name="Email" required>
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
            <div class="col-12">
                <button class="btn btn-primary" type="submit" name="Ajouter">Ajouter Utilisateur</button>
            </div>
        </form>
    </div>
    
</body>
</html>