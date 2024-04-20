<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                <a class="nav-link active" aria-current="page" href="#">Accueil</a>
                </li>
            </ul>
            <?php
            if(isset($_POST['connecte1'])){
                header('location: connexion.php');
            }
            ?>
            <form class="d-flex" role="search" methode="post">
                <button class="btn btn-outline-light" type="submit" name="connecte1" ><a class="nav-link" aria-current="page" href="connexion.php">se connecter</a></button>
            </form>
            </div>
        </div>
    </nav>
</body>
</html>