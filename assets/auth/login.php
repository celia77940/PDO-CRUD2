<?php
session_start();
// On parametre les entrer sur null
$u_email = null;
$u_password = null;
// Supprime les balises HTML et PHP d'une chaîne
$u_email = strip_tags($_POST['u_email']);
$u_password = strip_tags($_POST['u_password']);

// Si quelque chose est déclaré
if (isset($_POST['u_email']) && isset($_POST['u_password'])){

    // On se connect à la base de données
    require_once('../require/connect.php');

    // On prepare une demande de récuperer tout dans colonne email de la table user
    $query = $db->prepare('SELECT * FROM user WHERE u_email = :u_email ;');

    // lie le param à ma var query
    $query->bindParam(':u_email', $u_email);

    // excute tt les param rentrer
    $query->execute();

    // Me rappel plus à quoi sa sert
    $result = $query->fetch(PDO::FETCH_ASSOC);

    // Si L'email rentrer & le mdp correspond à celui trouver dans la db alors on accede à la connexion
    if($u_email === $result['u_email'] && $u_password === $result['u_password']){
        $_SESSION['u_email'] = $u_email;
        $_SESSION['u_password'] = $u_password;
        header('location:../../produit.php');

    // Sinon On retourne à la page login avec un message d'erreur
    }else{

        $_SESSION['error'] = "Email ou Mot de passe Incorrect";
        header('location:../../index.php');
    }
    
}

?>
