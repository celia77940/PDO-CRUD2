<?php

// Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('connect.php');

    //on nettoie l'id envoyé
    $id = strip_tags($_GET['id']); /*Cest une fonction qui enleve tout les balise directement de l'id*/

    $sql = 'SELECT * FROM produits WHERE id = :id;'; //:id ejecte la valeur

    //On prepare la requete

    $query = $db->prepare($sql);

    //On accroche les parametre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT); /*Associe une valeur à un parametre*///Représente le type de données INTEGER SQL pour avoir un nombre entier

    //On execute la requete
    $query->execute();

    //On récupère le produit
    $produit = $query->fetch();

    //verifie si le produit existe
    if(!$produit){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location:../../produit.php');
        die();
    }
    

    $sql = 'DELETE FROM produits WHERE id = :id;'; //:id ejecte la valeur

    //On prepare la requete

    $query = $db->prepare($sql);

    //On accroche les parametre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT); /*Associe une valeur à un parametre*/ //Représente le type de données INTEGER SQL pour avoir un nombre entier

    //On execute la requete
    $query->execute();
    $_SESSION['message'] = "Votre Produit à été supprimé";
    header('Location:../../produit.php');

    }else{
    $_SESSION['message'] = "Produit supprimé";
    header('Location:../../produit.php');
    }

?>