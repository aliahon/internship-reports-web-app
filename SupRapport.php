<?php
require_once 'include/database.php';
$id = $_GET['id'];
$sqlStat = $pdo -> prepare('DELETE FROM rapports_stage WHERE ID_rapport = ?');
$supprimer1 = $sqlStat -> execute([$id]);
$sqlState = $pdo -> prepare('DELETE FROM rapports_etudiants WHERE ID_rapport = ?');
$supprimer2 = $sqlState -> execute([$id]);

if($supprimer1 && $supprimer2){
    header('location: rapport.php');
}
else{
    echo "Erreur : Le rapport n'a pas été correctement supprimé. Veuillez réessayer.";
}