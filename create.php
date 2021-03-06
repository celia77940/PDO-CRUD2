<?php
// on demarre la session
session_start();

// Si le mail et le mdp ne sont pas stocker dans la global session alors redirection pas login
if(!isset($_SESSION['u_email']) && !isset($_SESSION['u_password'])){
    $_SESSION['nolog'] = "Veuillez vous identifiez";
    header('location:index.php');
}

// Est-ce que tout les noms de table existe et ne sont pas vide
if($_POST && $_FILES){
    if(isset($_POST['lieux']) && !empty($_POST['lieux'])
    && isset($_POST['nom']) && !empty($_POST['nom'])
    && isset($_POST['reference']) && !empty($_POST['reference'])
    && isset($_POST['categorie']) && !empty($_POST['categorie'])
    && isset($_POST['dateachat']) && !empty($_POST['dateachat'])
    && isset($_POST['garantie']) && !empty($_POST['garantie'])
    && isset($_POST['prix']) && !empty($_POST['prix'])
    && isset($_POST['conseil']) && !empty($_POST['conseil'])
    && isset($_FILES['ticket']) && !empty($_FILES['ticket'])
    && isset($_POST['manuel'])){
            
            //On fait la connection à la base
            require_once('assets/require/connect.php');
            

                // On nettoie les données envoyées
                $lieux = strip_tags($_POST['lieux']);
                $nom = strip_tags($_POST['nom']);
                $reference = strip_tags($_POST['reference']);
                $categorie = strip_tags($_POST['categorie']);
                $dateachat = strip_tags($_POST['dateachat']);
                $garantie = strip_tags($_POST['garantie']);
                $prix = strip_tags($_POST['prix']);
                $conseil = strip_tags($_POST['conseil']);
                $ticket = strip_tags($_POST['ticket']);
                $manuel = strip_tags($_POST['manuel']);

                //Met dans la var le chemin ou je veux que le ticket soit sauvegarder
                $uploadchemin = 'assets/imgticket/';
                //On insert dans la var $uploadfile le chemin plus nom du fichier envoyer dans la $_FILES
                $uploadfichier = $uploadchemin . basename($_FILES['ticket']['name']);
                // Si le fichier télécharger n'est pas déplacé à l'endroit indiqué
                if (!move_uploaded_file($_FILES['ticket']['tmp_name'], $uploadfichier)){
                    $_SESSION['erreurticket'] = "Il y'a eu un problème avec l'importation du ticket";
                }

                $sql = 'INSERT INTO `produits` (`lieux`, `nom`, `reference`, `categorie`, `dateachat`, `garantie`, `prix`, `conseil`, `ticket`, `manuel`) VALUES (:lieux, :nom, :reference, :categorie, :dateachat, :garantie, :prix, :conseil, :ticket, :manuel)';

                $query = $db->prepare($sql);

                $query->bindValue(':lieux', $lieux, PDO::PARAM_STR);
                $query->bindValue(':nom', $nom, PDO::PARAM_STR);
                $query->bindValue(':reference', $reference, PDO::PARAM_STR);
                $query->bindValue(':categorie', $categorie, PDO::PARAM_STR);
                $query->bindValue(':dateachat', $dateachat, PDO::PARAM_STR);
                $query->bindValue(':garantie', $garantie, PDO::PARAM_STR);
                $query->bindValue(':prix', $prix, PDO::PARAM_STR);
                $query->bindValue(':conseil', $conseil, PDO::PARAM_STR);
                $query->bindValue(':ticket', $uploadfichier, PDO::PARAM_STR);
                $query->bindValue(':manuel', $manuel, PDO::PARAM_STR);

                $query->execute();

                $_SESSION['message'] = "Ajouter avec succès";
                
                require_once('assets/require/close.php');

                header('Location:produit.php');

           


    }else{
        $_SESSION['erreur'] = "Formulaire incomplet";
    }
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Creation d'un produit</title>
</head>
<body>
<div class="container-fluid">
    <!--    start navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top mb-2">
        <div class="container-fluid">
            <!--            -->
            <a class="navbar-brand" href="#">
                <img class="rounded-circle" src="" alt="" loading="lazy">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="produit.php" class="nav-link">Liste</a></li>
                    <li class="nav-item"><a href="create.php" class="nav-link active">Ajouter</a></li>
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="assets/require/deconnection.php" class="nav-link">Se déconnecter</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!--    end navbar-->
    <!-- message d'erreur -->
    <?php
        if(!empty($_SESSION['erreur'])){
            echo '<div class="alert alert-danger" role="alert">
                    '. $_SESSION ['erreur'].'
                </div>';
                $_SESSION['erreur'] = '';
        }
        ?>
         <?php
        if(!empty($_SESSION['erreurticket'])){
            echo '<div class="alert alert-danger" role="alert">
                    '. $_SESSION ['erreurticket'].'
                </div>';
                $_SESSION['erreurticket'] = '';
        }
        ?>
    <!--    start container -->
    <div class="container">
        <h1 class="ml-5">Creer le produit</h1>
        <div class="row">
            <div class="col-6">
                <!--              start form-->
                <form method="POST" action="" enctype="multipart/form-data">
                    <!--                  start lieux-->
                    <div class="form-group">
                        <label for="">Lieux d'achat</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="lieux" id="direct" value="direct">
                            <label class="form-check-label" for="direct">
                                Vente direct
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="lieux" id="indirect" value="indirect">
                            <label class="form-check-label" for="indirect">
                                Vente indirect
                            </label>
                        </div>
                        <label for="address" class="mt-3">L'adresse ou l Url de e-commerce </label>
                        <input type="text" class="form-control" name="lieux">
                    </div>
                    <!--                  end lieux-->
                    <!--                  start nom-->
                    <div class="form-group">
                        <label  for="">Nom du produit </label>
                        <input type="text" class="form-control" name="nom">
                    </div>
                    <!--                  end nom-->
                    <!--                  start reference-->
                    <div class="form-group">
                        <label for="">Reference</label>
                        <input type="text" class="form-control" name="reference">
                    </div>
                    <!--                  end reference-->
                    <!--                  start categorie-->
                    <div class="form-group">
                        <label  for="">Categorie</label> <br>
                        <select name="categorie" id="categorie">
                        <option valu="Electromenager">Electromenager</option>
                        <option valu="Tv_HIFI">Tv_HIFI</option>
                        <option valu="Bricolage">Bricolage</option>
                        <option valu="Voiture">Voiture</option>
                        <option valu="Autre">Autre</option>
                        </select>
                    </div>
                    <!--                  end categorie-->
                    <!--                  start date d'achat-->
                    <div class="form-group">
                        <label  for="">Date d'achat</label>
                        <input type="date" class="form-control" name="dateachat">
                    </div>
                    <!--                  end date d'achat-->
                    <!--                  start date de fin de garantie-->
                    <div class="form-group">
                        <label  for="">Date expiration garantie</label>
                        <input type="date" class="form-control" name="garantie">
                    </div>
                    <!--                  end date de fin de garantie-->
                    <!--                  start prix-->
                    <div class="form-group">
                        <label for="">Prix</label>
                        <input type="text" class="form-control" name="prix">
                    </div>
                    <!--                  ent prix-->
                    <!--                  start zone-->
                    <div class="form-group">
                        <label for="">conseil</label>
                    </div>
                    <!--                  ent zone-->
                    <!--                  start description-->
                    <div class="form-group">
                        <textarea class="form-control" name="conseil"></textarea>
                    </div>
                    <!--                  end description-->
                    <!--                  start photo de ticket d'achat-->
                    <div class="form-group">
                        <label for="">Photo du ticket d'achat</label> <br>
                        <input type="file" name="ticket">
                    </div>
                    <!--                  end photo du ticket d'achat-->
                    <!--                  start manuel d'utilisation-->
                    <div class="form-group">
                        <label for="">Manuel d'utilisation</label>
                        <input type="text" class="form-control" name="manuel">
                    </div>
                    <!--                  end manuel d'utilisation-->
                    <!--                  start button submit-->
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <!--                  end button submit-->
                </form>
                <!--              end form-->
            </div>
        </div>
    </div>
    <!--    end container-->
</div>
</body>
</html>
