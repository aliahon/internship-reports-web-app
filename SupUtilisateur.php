<?php
require_once 'include/database.php';
$id = $_GET['ID_utilisateur'];
$sqlStat = $pdo -> prepare('SELECT * FROM utilisateurs WHERE ID_utilisateur =?');
$sqlStat -> execute([$id]);
$utilisateur = $sqlStat ->fetch();
$role = $utilisateur['ID_role'];
switch ($role){
    case 2 : 
        $sqlState = $pdo -> prepare('DELETE FROM chefs_departement WHERE ID_utilisateur = ?');
        $sqlState -> execute([$id]);   
        break;

    case 3 : 
        $sqlState = $pdo -> prepare('DELETE FROM secretaires_departement WHERE ID_utilisateur = ?');
        $sqlState -> execute([$id]);   
        break;
            
    case 4 : 
        $sqlState = $pdo -> prepare('DELETE FROM etudiant WHERE ID_utilisateur = ?');
        $sqlState -> execute([$id]);  
        break;
}

$sqlStat = $pdo -> prepare('DELETE FROM utilisateurs WHERE ID_utilisateur = ?');
$supprimer1 = $sqlStat -> execute([$id]);

header('location: utilisateur.php');
