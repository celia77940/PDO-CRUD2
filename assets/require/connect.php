<?php
try{
    // Connexion base de donnée
    $db = new PDO('mysql:host=127.0.0.1;dbname=produits', 'root','');
    $db->exec('SET NAMES "UTF8"');

}catch (PDOException $e){
    echo 'Erreur : '. $e->getMessage();
    die();
}