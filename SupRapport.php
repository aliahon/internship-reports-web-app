<?php
require_once 'include/database.php';
$id = $_GET['id'];
$sqlStat = $pdo -> prepare('SELECT Chemin_fichier FROM rapports_stage WHERE ID_rapport = ?');
$sqlStat -> execute([$id]);
$rapport = $sqlStat ->fetchAll(PDO::FETCH_ASSOC);
$fileToDelete = $rapport[0]['Chemin_fichier'];

// Check if the file exists
if (file_exists($fileToDelete)) {
    // Attempt to delete the file
    if (unlink($fileToDelete)) {
        echo "File deleted successfully.";
    } else {
        echo "Unable to delete the file.";
    }
} else {
    echo "File does not exist.";
}

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