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
    $noms = $_POST['noms'];
    $mdp = $_POST['mdp'];
    
    $requete = $connexion->prepare("SELECT ID, mdp, roles FROM utilisateurs WHERE noms = ?");
    $requete->bind_param("s", $noms);
    $requete->execute();
    $requete->bind_result($id, $hash_mdp, $roles);
    $requete->fetch();
    
    if (password_verify($mdp, $hash_mdp)) {
        $_SESSION['ID'] = $id;
        $_SESSION['roles'] = $roles;
        header("Location: messages.php");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap">
    <style>
        @import url(style.css);
        @import url(components/sidebar.css);
        @import url(icons.css);

        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
        }
        .container {
            margin: 0 auto;
            text-align: center;
            max-width: 400px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .container h1 {
            margin-bottom: 20px;
        }
        .container img {
            width: 100px;
            margin-bottom: 20px;
        }
        .container p {
            margin-bottom: 20px;
        }
        form div {
            margin-bottom: 15px;
            text-align: left;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"],
        button {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="text"],
        input[type="password"] {
            margin-bottom: 10px;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .wave {
            /* Sample wave animation */
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: url('wave.png') repeat-x;
            animation: wave-animation 5s linear infinite;
            z-index: -1;
        }
        @keyframes wave-animation {
            0% {
                background-position-x: 0;
            }
            100% {
                background-position-x: 1000px;
            }
        }
    </style>
</head>
<body>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="container">
        <h1>Connexion</h1>
        <?php if (isset($message)) { echo "<p class='message'>$message</p>"; } ?>
        <form method="POST">
            <div>
                <label for="noms">Nom d'utilisateur :</label>
                <input type="text" id="noms" name="noms" required>
            </div>
            <div>
                <label for="mdp">Mot de passe :</label>
                <input type="password" id="mdp" name="mdp" required>
            </div>
            <div>
                <button type="submit" name="login">Connexion</button>
            </div>
        </form>
    </div>
</body>
</html>
