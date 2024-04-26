<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
</head>
<body data-bs-theme="dark">
<nav class="navbar  navbar-expand-lg  bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">RStageENSAA</a>
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
    <div   style=" padding : 5% 30%"  data-bs-theme="dark">
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
                            case 2 : 
                                header('location: chef.php');
                                break;

                            case 3 : 
                                header('location: secretaire.php');
                                break;
                                
                            case 4 : 
                                header('location: etudiant.php');
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
        <h4>Connexion!</h4>
        <form method="post">
            <div class="mb-3" style="margin-top: 50px;">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name ="Email">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name ="Mot de passe">
            </div>
            <button type="submit" class="btn btn-primary" name ="connecte">se connecte</button>
        </form>
    </div>
    
</body>
</html>