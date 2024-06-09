<!--Ecoline-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <!--Meta-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


// Récupérer les informations entrées par l'utilisateur
$username = $_POST['username'];
$password = $_POST['password'];

    <!--CSS-->
    <style type="text/css">
        @import url(style.css);
        @import url(components\sidebar.css);
        @import url(icons.css);
        @import url(components/sidebar.css);
    </style>
    <!--FONT-->
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


