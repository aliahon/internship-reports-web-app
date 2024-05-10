<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body data-bs-theme="dark" style="text-align: center;">
    <?php include 'include/nav.php'?>
    <?php include 'include/securité.php' ?>
    <div class="container row row-cols-1 row-cols-md-2 g-4" style=" padding : 5% 0% 0% 15%">

        <div class="col">
            <div class="card border border-primary shadow-0 mb-3" style="max-width: 35rem;">
                <div class="card-header text-bg-primary" style="text-align: center;">Utilisateurs par Rôle</div>
                    <div class="card-body text-primary d-flex justify-content-center rounded-3 p-2 mb-2">
                        <div>
                            <p class="text-muted mb-1"></p>
                            <p class="mb-0"></p>
                        </div>
                        <div class="px-3">
                            <p class="text-muted mb-1">Total</p>
                            <p class="mb-0">
                                <?php
                                    require_once 'include/database.php';
                                    $countUtilisateur = $pdo->query("SELECT COUNT(*)
                                                            FROM utilisateurs;")->fetch();
                                    echo $countUtilisateur[0];
                                ?>
                            </p>
                        </div>
                        <div>
                            <p class="text-muted mb-1"></p>
                            <p class="mb-0"></p>
                        </div>
                    </div>
                    <div class="card-body text-primary d-flex justify-content-center rounded-3 p-2 mb-2">
                                <?php
                                    require_once 'include/database.php';
                                    $counter = $pdo->query("SELECT COUNT(*)
                                                            FROM utilisateurs
                                                            GROUP BY ID_role;")->fetchAll(PDO::FETCH_ASSOC);
                                ?>
                        <div>
                            <p class="text-muted mb-1">Admins</p>
                            <p class="mb-0"><?php echo $counter[0]["COUNT(*)"]; ?></p>
                        </div>
                        <div class="px-3">
                            <p class="text-muted mb-1">Chefs</p>
                            <p class="mb-0"><?php echo $counter[1]["COUNT(*)"]; ?></p>
                        </div>
                        <div>
                            <p class="text-muted mb-1">Secretaires</p>
                            <p class="mb-0"><?php echo $counter[2]["COUNT(*)"]; ?></p>
                        </div>
                        <div class="px-3">
                            <p class="text-muted mb-1">Etudiants</p>
                            <p class="mb-0"><?php echo $counter[3]["COUNT(*)"]; ?></p>
                        </div>
                    </div>
            </div> 
        </div>
        <div class="col">
            <div class="card border border-danger shadow-0 mb-3" style="max-width: 35rem;">
                    <div class="card-header text-bg-danger" style="text-align: center;">Etudiants par Filière</div>
                    <div class="card-body text-danger d-flex justify-content-center rounded-3 p-2 mb-2">
                        <div>
                            <p class="text-muted mb-1"></p>
                            <p class="mb-0"></p>
                        </div>
                        <div class="px-3">
                            <p class="text-muted mb-1">Total</p>
                            <p class="mb-0">
                            <?php
                                    require_once 'include/database.php';
                                    $countUtilisateur = $pdo->query("SELECT COUNT(*)
                                                            FROM etudiant;")->fetch();
                                    echo $countUtilisateur[0];
                                ?>
                            </p>
                        </div>
                        <div>
                            <p class="text-muted mb-1"></p>
                            <p class="mb-0"></p>
                        </div>
                    </div>
                    <div class="card-body text-danger d-flex justify-content-center rounded-3 p-2 mb-2">
                        <?php
                                    require_once 'include/database.php';
                                    $counter = $pdo->query("SELECT COUNT(*)
                                                            FROM etudiant
                                                            GROUP BY ID_filiere;")->fetchAll(PDO::FETCH_ASSOC);
                                ?>
                        <div>
                            <p class="text-muted mb-1">GINFO</p>
                            <p class="mb-0"><?php echo $counter[0]["COUNT(*)"]; ?></p>
                        </div>
                        <div class="px-3">
                            <p class="text-muted mb-1">GINDUS</p>
                            <p class="mb-0"><?php echo $counter[1]["COUNT(*)"]; ?></p>
                        </div>
                        <div class="px-3">
                            <p class="text-muted mb-1">BTP</p>
                            <p class="mb-0"><?php echo $counter[2]["COUNT(*)"]; ?></p>
                        </div>
                        <div class="px-3">
                            <p class="text-muted mb-1">GE</p>
                            <p class="mb-0"><?php echo $counter[3]["COUNT(*)"]; ?></p>
                        </div>
                        <div>
                            <p class="text-muted mb-1">FID</p>
                            <p class="mb-0"><?php echo $counter[4]["COUNT(*)"]; ?></p>
                        </div>
                        <div class="px-3">
                            <p class="text-muted mb-1">GM</p>
                            <p class="mb-0"><?php echo $counter[5]["COUNT(*)"]; ?></p>
                        </div>
                        <div>
                            <p class="text-muted mb-1">GEE</p>
                            <p class="mb-0"><?php echo $counter[6]["COUNT(*)"]; ?></p>
                        </div>
                    </div>
            </div>  
        </div>
        
        <div class="col">
            <div class="card border border-warning shadow-0 mb-3" style="max-width: 35rem;">
                <div class="card-header text-bg-warning" style="text-align: center;">Etudiants par Niveau</div>
                <div class="card-body text-warning d-flex justify-content-center rounded-3 p-2 mb-2">
                    <div>
                        <p class="text-muted mb-1"></p>
                        <p class="mb-0"></p>
                    </div>
                    <div class="px-3">
                        <p class="text-muted mb-1">Total</p>
                        <p class="mb-0">
                        <?php
                                    require_once 'include/database.php';
                                    $countUtilisateur = $pdo->query("SELECT COUNT(*)
                                                            FROM etudiant;")->fetch();
                                    echo $countUtilisateur[0];
                                ?>
                        </p>
                    </div>
                    <div>
                        <p class="text-muted mb-1"></p>
                        <p class="mb-0"></p>
                    </div>
                </div>
                <div class="card-body text-warning d-flex justify-content-center rounded-3 p-2 mb-2">
                <?php
                                    require_once 'include/database.php';
                                    $counter = $pdo->query("SELECT COUNT(*)
                                                            FROM etudiant
                                                            GROUP BY ID_niveau;")->fetchAll(PDO::FETCH_ASSOC);
                                ?>
                    <div>
                        <p class="text-muted mb-1">1ère année CI</p>
                        <p class="mb-0"><?php echo $counter[0]["COUNT(*)"]; ?></p>
                    </div>
                    <div class="px-3">
                        <p class="text-muted mb-1">2ème année CI</p>
                        <p class="mb-0"><?php echo $counter[1]["COUNT(*)"]; ?></p>
                    </div>
                    <div>
                        <p class="text-muted mb-1">3ème année CI</p>
                        <p class="mb-0"><?php echo $counter[2]["COUNT(*)"]; ?></p>
                    </div>
                </div>
            </div> 
        </div>

        <div class="col">
            <div class="card border border-success shadow-0 mb-3" style="max-width: 35rem;">
                <div class="card-header text-bg-success" style="text-align: center;">Rapport par Filiere</div>
                <div class="card-body text-success d-flex justify-content-center rounded-3 p-2 mb-2">
                    <div>
                        <p class="text-muted mb-1"></p>
                        <p class="mb-0"></p>
                    </div>
                    <div class="px-3">
                        <p class="text-muted mb-1">Total</p>
                        <p class="mb-0">
                                <?php
                                    require_once 'include/database.php';
                                    $countUtilisateur = $pdo->query("SELECT COUNT(*)
                                                            FROM rapports_stage;")->fetch();
                                    echo $countUtilisateur[0];
                                ?>
                        </p>
                    </div>
                    <div>
                        <p class="text-muted mb-1"></p>
                        <p class="mb-0"></p>
                    </div>
                </div>
                <div class="card-body text-success d-flex justify-content-center rounded-3 p-2 mb-2">
                        <?php
                            $counter = $pdo->query("SELECT COUNT(DISTINCT RS.ID_rapport) AS report_count, F.ID_filiere
                            FROM filieres F
                            LEFT JOIN etudiant E ON F.ID_filiere = E.ID_filiere
                            LEFT JOIN rapports_etudiants RE ON E.ID_etudiant = RE.ID_etudiant
                            LEFT JOIN rapports_stage RS ON RE.ID_rapport = RS.ID_rapport
                            GROUP BY F.ID_filiere")->fetchAll(PDO::FETCH_ASSOC);
                        ?>

                        <div>
                            <p class="text-muted mb-1">GINFO</p>
                            <p class="mb-0"><?php echo $counter[0]["report_count"]; ?></p>
                        </div>
                        <div class="px-3">
                            <p class="text-muted mb-1">GINDUS</p>
                            <p class="mb-0"><?php echo $counter[1]["report_count"]; ?></p>
                        </div>
                        <div class="px-3">
                            <p class="text-muted mb-1">BTP</p>
                            <p class="mb-0"><?php echo $counter[2]["report_count"]; ?></p>
                        </div>
                        <div class="px-3">
                            <p class="text-muted mb-1">GE</p>
                            <p class="mb-0"><?php echo $counter[3]["report_count"]; ?></p>
                        </div>
                        <div>
                            <p class="text-muted mb-1">FID</p>
                            <p class="mb-0"><?php echo $counter[4]["report_count"]; ?></p>
                        </div>
                        <div class="px-3">
                            <p class="text-muted mb-1">GM</p>
                            <p class="mb-0"><?php echo $counter[5]["report_count"]; ?></p>
                        </div>
                        <div>
                            <p class="text-muted mb-1">GEE</p>
                            <p class="mb-0"><?php echo $counter[6]["report_count"]; ?></p>
                        </div>
            </div>    
        </div>




    </div>
</body>
</html>