<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explorer les rapports de stage de l'ENSAA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
        <script type="text/javascript">
            (function(){
                emailjs.init('CZGsgydi-ioEiz8ZU') })();
        </script>
    <style>
        .navbar {
            background-color: #343a40;
        }

        .about-us {
            background-color: #212529;
            padding: 50px 0;
        }

        .form-control {
            background-color: #343a40;
            border-color: #343a40;
            color: #ffffff;
        }

        .form-control:focus {
            background-color: #495057;
            border-color: #495057;
            color: #ffffff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        #hello {
            background: url('img/1.png') no-repeat center top;
            background-size: contain;
            height: 110vh;
        }

        #intro {
            background: url('img/2.png') no-repeat center top;
            background-size: contain;
            height: 100vh; 
        }
        
        #goals {
            background: url('img/3.png') no-repeat center top;
            background-size: contain;
            height: 100vh; 
        }
        
        #fin {
            background: url('img/4.png') no-repeat center top;
            background-size: contain;
            height: 110vh;
        }

        #finisio {
            background: url('img/5.png') no-repeat center top;
            background-size: contain;
            height: 100vh;
        }
    </style>
</head>
<body data-bs-theme="dark">
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-body-tertiary sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">StageENSAA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#intro">Introduction</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#goals">Bénéfices</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contactez-nous</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#finisio">Contact Infos</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" method="post">
                    <button class="btn btn-outline-light" type="submit" name="connecte1"><a class="nav-link" aria-current="page" href="connexion.php">Se connecter</a></button>
                </form>
            </div>
        </div>
    </nav>
    
    <div id="hello">
    </div>

    <div id="intro">
    </div>

    <div id="goals">
    </div>

    <div id="fin">
    </div>
    <div class="contact-form my-5" id="contact" style="padding:5%;">
        <div class="container">
            <h2 class="text-center">Contactez-nous</h2>
            <form  method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Adresse e-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-primary" onclick="sendMail()">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
    <div id="finisio">
    </div>

    <script>
        function sendMail() {
            var params = {
                name: document.getElementById("name").value,
                email: document.getElementById("email").value,
                message: document.getElementById("message").value 
            };
            emailjs.send("service_ogmuq9t","template_1tvjccu", params)
                .then(function (res) {
                    alert("Success! " + res.status);
                    // Réinitialiser les champs du formulaire
                    document.getElementById("name").value = "";
                    document.getElementById("email").value = "";
                    document.getElementById("message").value = "";
                })
                .catch(function (error) {
                    alert("Error: " + error);
                });
        }
    </script>

</body>
</html>
