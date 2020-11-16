<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>login</title>
</head>
<body>
<h1>Connexion</h1>
<div style="margin-top:5%" class="container shadow-lg p-3 mb-5 bg-white rounded">
<form action="assets/auth/login.php" method="post">
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="u_email" id="u_email" aria-describedby="emailHelp">
        <small id="email" class="form-text text-muted">Nous ne partagerons jamais votre e-mail avec personne d'autre.</small>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" name="u_password" id="u_password">
    </div>

    <button  type="submit" class="btn btn-dark">Acceder</button>
</form>
</div>
</body>
</html>