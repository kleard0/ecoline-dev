<?php
session_start();

$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "ecoline";

$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

if ($connexion->connect_error) {
    die("Échec de la connexion : " . $connexion->connect_error);
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $requete = $connexion->prepare("SELECT user_id, password, account_type FROM users WHERE username = ?");
    $requete->bind_param("s", $username);
    $requete->execute();
    $requete->bind_result($id, $hash_mdp, $roles);
    $requete->fetch();
    
    if (password_verify($password, $hash_mdp)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['account_type'] = $roles;
        header("Location: gestion.php");
        exit;
    } else {
        $message = "Nom ou mot de passe incorrect";
    }
    $requete->close();
}

$connexion->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            max-width: 400px;
            margin: 100px auto;
        }

        h1 {
            text-align: center;
            font-weight: 500;
        }

        form div {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="password"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #284B63;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #284B63;
        }

        .message {
            text-align: center;
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Connexion</h1>
        <?php if (isset($message)) { echo "<p class='message'>$message</p>"; } ?>
        <form method="POST">
            <div>
                <label for="noms">Nom :</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="mdp">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <input type="submit" name="login" value="Connexion">
            </div>
        </form>
    </div>
</body>
</html>
