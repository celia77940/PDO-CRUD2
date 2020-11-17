<?php
//On démarre une session
session_start();

// Si le mail et le mdp ne sont pas stocker dans la global session alors redirection pas login
if(!isset($_SESSION['u_email']) && !isset($_SESSION['u_password'])){
    $_SESSION['nolog'] = "Veuillez vous identifiez";
    header('location:index.php');
}

// On inclut la connexion à la base 
require_once('assets/require/connect.php');

$sql = 'SELECT * FROM produits'; //On demande de selectionner toute la table

//On prépare la requete
$query = $db->prepare($sql);

//On execute la requête
$query->execute();

//On stocke le résultat dans un tableau associatif
$result = $query ->fetchAll(PDO::FETCH_ASSOC); //Permet de demander que je veux que dans mes resultat que les information des titre dans mes collonnes

require_once('assets/require/close.php');

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <!-- lien vers bootstrap-->
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Liste des produits</title>
</head>
<body>
<span class="border-bottom-0"></span>
<div class="container-fluid">
    <!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top mb-2">
        <div class="container-fluid">
            
            <a class="navbar-brand" href="#"></a>
            <!--boutton qui apparait en responsive-->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <!--boutton ajouter et bouton liste-->
                    <li class="nav-item"><a href="index.php" class="nav-link active">Liste</a></li>
                    <li class="nav-item"><a href="create.php" class="nav-link">Ajouter</a></li>
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <!--boutton de deconnexion-->
                    <li class="nav-item"><a href="assets/require/deconnection.php" class="nav-link">Se déconnecter</a></li>
                </ul>
            </div>

        </div>
    </nav>
    <?php
        if(!empty($_SESSION['message'])){
            echo '<div class="alert alert-success" role="alert">
                    '. $_SESSION ['message'].'
                </div>';
            $_SESSION['message'] = "";
            }
            ?>
    </div>
    <div class="container">
        <h2>Liste des produits</h2>
        <table class="table table-striped shadow-lg p-3 mb-5 bg-white rounded table table-hover">
            <thead>
            <!--liste des produits-->
            <th style="text-align: center">id</th>
            <th style="text-align: center">Lieux d'achat</th>
            <th style="text-align: center">Nom du produit</th>
            <th style="text-align: center">Référence du produit</th>
            <th style="text-align: center">Catégorie</th>
            <th style="text-align: center">Date d'achat</th>
            <th style="text-align: center">Date de fin de garantie</th>
            <th style="text-align: center">Prix</th>
            <th style="text-align: center">Description</th>
            <th style="text-align: center">Photo du tiket d'achat</th>
            <th style="text-align: center">Manuel d'utlisation</th>
            <th colspan="2">Actions</th>
            </thead>
            <tbody>
            <?php
                //On boucle sur la variable result
                foreach($result as $produit){
            ?>
                <tr>
                <td><?=$produit['id']?></td>
                <td><?=$produit['lieux']?></td>
                <td><?=$produit['nom']?></td>
                <td><?=$produit['reference']?></td>
                <td><?=$produit['categorie']?></td>
                <td><?=$produit['dateachat']?></td>
                <td><?=$produit['garantie']?></td>
                <td><?=$produit['prix']?></td>
                <td><?=$produit['conseil']?></td>
                <td><?=$produit['ticket']?></td>
                <td><?=$produit['manuel']?></td>
                <td>
                    <a href="update.php?id=<?=$produit['id']?>"class="btn btn-primary btn-sm, far fa-edit" type="button"></a>
                </td>
                <td>
                    <a href="assets/require/delete.php?id=<?=$produit['id']?>"class="btn btn-danger btn-sm, far fa-trash-alt" type="button"></a>
                </td>
            <?php 
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<!--javascript-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
</body>
</html>