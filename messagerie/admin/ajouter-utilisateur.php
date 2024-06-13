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

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $noms = $_POST['noms'];
    $roles = $_POST['roles'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

    $requete = $connexion->prepare("INSERT INTO utilisateurs (first_name, last_name, noms, roles, email, phone, mdp) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $requete->bind_param("sssssss", $first_name, $last_name, $noms, $roles, $email, $phone, $mdp);

    if ($requete->execute()) {
        $message = "Nouvel utilisateur ajouté avec succès.";
    } else {
        $message = "Erreur : " . $requete->error;
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
    <title>Ajouter Utilisateur</title>
    <style>
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
        form {
            margin-bottom: 20px; /* Ajout de marge en bas du formulaire */
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
        input[type="email"],
        input[type="tel"],
        input[type="password"] {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        select {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            margin-top: 20px;
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
            padding: 10px;
            border-radius: 5px;
            display: <?php echo ($message != '') ? 'block' : 'none'; ?>;
        }
        .back-button {
            display: block;
            margin-top: 10px; /* Ajout de marge au-dessus du bouton */
            padding: 10px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ajouter Utilisateur</h1>
        <form method="POST">
            <div>
                <label for="first_name">Prénom :</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
            <div>
                <label for="last_name">Nom :</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>
            <div>
                <label for="noms">Identifiant :</label>
                <input type="text" id="noms" name="noms" required>
            </div>
            <div>
                <label for="roles">Rôle :</label>
                <select id="roles" name="roles" required>
                    <option value="parent">Parent</option>
                    <option value="teacher">Enseignant</option>
                    <option value="student">Étudiant</option>
                    <option value="direction">Direction</option>
                </select>
            </div>
            <div>
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="phone">Téléphone :</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            <div>
                <label for="mdp">Mot de passe :</label>
                <input type="password" id="mdp" name="mdp" required>
            </div>
            <div>
                <button type="submit">Ajouter</button>
            </div>
        </form>
        <?php if ($message != ''): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        <a href="index.php" class="back-button">Retour</a>
    </div>
</body>
</html>
