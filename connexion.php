<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap CSS 
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
     Font Awesome 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
     Custom CSS -->
</head>
</head>
<body data-bs-theme="dark">
    <nav class="navbar  navbar-expand-lg  bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">StageENSAA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Connexion</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <div class="container" data-bs-theme="dark">
        <?php
            if(isset($_POST['connecte'])){
                $Email = $_POST['Email'];
                $mdp = $_POST['Mot_de_passe'];

                if(!empty($Email) && !empty($mdp)){
                    require_once 'include/database.php';
                    $sqlState = $pdo -> prepare('SELECT * FROM utilisateurs WHERE Email = ? AND Mdp = ?');
                    $sqlState -> execute([$Email, $mdp]);
                    
                    if($sqlState->rowCount() >= 1){
                        session_start();
                        $utilisateur=$sqlState -> fetch();
                        $_SESSION['utilisateur'] = $utilisateur;

                        $role = $utilisateur['ID_role'];
                        switch ($role){
                            case 1 : 
                                header('location: admin.php');
                                break;
                                
                            default : 
                                header('location: rapport.php');
                                break;
                        }
                        
                    }
                    else{
                        ?>
                        <div class="alert alert-danger" role="alert">
                            Email ou mot de passe est incorrect!
                        </div>
                        <?php
                    }
                }
                else { 
                    ?>
                    <div class="alert alert-danger" role="alert">
                        Email , mot de passe sont obligatoires!
                    </div>
                    <?php
                }
            }

        ?>

        <header class="py-4 text-center" style="padding:0 20%; margin:5% 0;">
            <h1>Explorer les rapports de stageENSAA</h1>
            <p>Découvrez notre plateforme pour accéder aux rapports de stage numérisés de l'École Nationale des Sciences Appliquées d'Agadir.</p>
        </header>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Connectez-vous</h5>
                            <form action="connexion.php" method="POST">
                                <div class="mb-3">
                                    <label for="email" class="form-label"></label>
                                    <input type="email" class="form-control" id="email" name="Email" placeholder="Adresse e-mail" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label"></label>
                                    <input type="password" class="form-control" id="password" name="Mot_de_passe" placeholder="Mot de passe" required>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary" name="connecte">Se connecter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>