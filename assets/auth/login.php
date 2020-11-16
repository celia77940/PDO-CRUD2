<?php
$login=$_POST['u_email'];
$password=$_POST['u_password'];
$pdo= new PDO('mysql:host=localhost;dbname=produits;charset=utf8', 'root', '' );
$requette=$pdo->query("SELECT * FROM user where u_email = '$login' and u_password = '$password'" );
$response=$requette->fetch(PDO::FETCH_ASSOC);

if (isset($response['u_email'])){
  header('location:../../produit.php');
}
else{
    header('location:../../index.php');
    }

?>
