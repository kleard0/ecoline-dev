<?php
// Configuration de la base de données
$host = 'localhost';
$dbname = 'ecoline';
$username = 'message';
$password = '4VZzATv&jiCV5Jo*5m5i@!X^#PbK9ijx';


// Récupérer les informations entrées par l'utilisateur
$username = $_POST['username'];
$password = $_POST['password'];

// Connexion à la base de données

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            margin: 0 auto;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Connexion</h1>
    <img src="image/logo-ecoline.png" alt="Logo"><br>
    <p>Veuillez vous connecter</p>
    <form method="POST" action="">
        <label for="username">Utilisateur :</label>
        <input type="text" name="username" id="username" required><br>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required><br>
        <input type="submit" value="Login">
    </form>
</div>
</body>
</html>
