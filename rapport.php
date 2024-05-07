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
    <style>
        body {
            font-family: "Lato", sans-serif;
        }

        #filieres{
            background-color: #001432;
        }
        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #001432;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }
        li{
            list-style-type: none;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }
    </style>
</head>
<body data-bs-theme="dark">
    <?php include 'include/nav.php'?>
    <?php include 'include/securité.php' ?>
        <div id="mySidenav" class="sidenav" style="position: absolute; z-index:2;">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <li class="dropdown">
                <a class="dropdown-toggle" onclick="toggleDropdown()">
                    Filières
                </a>
                <ul class="dropdown-menu" id="filieres">
                    <?php
                        require_once 'include/database.php';
                        $filieres = $pdo -> query('SELECT * FROM filieres')->fetchAll(PDO::FETCH_ASSOC);
                        foreach($filieres as $filiere){
                    ?>
                    <li><a class="dropdown-item" href="#"><?php echo $filiere['Nom_filiere']?></a></li>
                    <?php
                        }
                    ?>
                </ul>
            </li>
        </div>
    <div class="container" style=" padding : 5% 0%" >
        <div class="row align-items-center">
            <div class="col-md-6">
                <span style="font-size:30px;cursor:pointer" onclick="openNav()"><i class="fa-solid fa-filter"></i>      Filtre</span>
            </div>
            <div class="col-md-6">
                <form class="input-group rounded" style="margin-bottom: 10px;">
                    <input id="myInput" type="text" placeholder="Search.." class="form-control rounded" aria-label="Search" aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                        <i class="fas fa-search"></i>
                    </span>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-Bmn0bEVxk2rRZyB8OHOTcG2OpnnVceKxF7GTlPRKlg/KRQdDUa9HVnWHM2dkcd9p" crossorigin="anonymous"></script>
    <script>
        function openNav() {
            var dropdownMenu = document.getElementById("filieres");
            dropdownMenu.style.display = "block";
            var dropdownWidth = dropdownMenu.offsetWidth; // Get the width of the dropdown menu
            var padding = 20; // Adjust the padding value as needed
            var desiredWidth = dropdownWidth + padding; // Add padding to the width

            document.getElementById("mySidenav").style.width = desiredWidth + "px";
        }

        function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        }

        function toggleDropdown() {
            var dropdownMenu = document.getElementById("filieres");
            if (dropdownMenu.style.display === "block") {
                dropdownMenu.style.display = "none";
            } else {
                dropdownMenu.style.display = "block";
            }
        }
    </script>

</body>
</html>