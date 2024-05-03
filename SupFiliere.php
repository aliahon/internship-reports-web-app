<?php
var_dump($_GET);
require_once 'include/database.php';
$id = $_GET['ID_filiere_'];
$sqlStat = $pdo -> prepare('DELETE FROM filieres WHERE ID_filiere = ?');
$supprimer = $sqlStat -> execute([$id]);

if($supprimer){
    header('location: filiere.php');
}
else{
    echo "Erreur : La filière n'a pas été correctement supprimé. Veuillez réessayer.";
}