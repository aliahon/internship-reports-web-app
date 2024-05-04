<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>filieres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body data-bs-theme="dark">
    <?php include 'include/nav.php'?>
    <div class="container" style=" padding : 5% 0%" >
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="col-12">
                    <button type="button" class="btn btn-primary btn-lg"><a href="AjouterFiliere.php"><i class="fa-solid fa-plus"></i></a></button>
                </div>
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

        <!--la liste des filieres-->
        <div class="card shadow mb-4" style=" margin-top : 10px;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">La liste des filières :</h6>
            </div>
            <div class="card-body" data-bs-theme="dark">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID_filière</th>
                                <th>Le nom de la filière</th>
                                <th>Opérations</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID_filière</th>
                                <th>Le nom de la filière</th>
                                <th>Opérations</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            require_once 'include/database.php';
                            $filieres = $pdo -> query('SELECT * FROM filieres')->fetchAll(PDO::FETCH_ASSOC);
                            foreach($filieres as $filiere){
                                ?>
                                    <tr>
                                        <td><?php echo $filiere['ID_filiere']?></td>
                                        <td><?php echo $filiere['Nom_filiere']?></td>
                                        <td >
                                            <a href="ModFiliere.php?ID_filiere =<?php echo $filiere['ID_filiere']?>" style="margin-left:10%;"><i class="fa-solid fa-pen-to-square"></i></a >
                                            <a href="SupFiliere.php?ID_filiere =<?php echo $filiere['ID_filiere']?>" style="margin-left:10px;" onclick="return confirm('Voulez-vous vraiment SUPPRIMER cette filiére?');"><i class="fa-solid fa-trash-can"></i></a >
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

    </div> 4
    
    <script>
        $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#dataTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        });
    </script>
    
</body>
</html>