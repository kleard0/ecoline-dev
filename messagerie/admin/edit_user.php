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

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $noms = $_POST['noms'];
        $roles = $_POST['roles'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $mdp = $_POST['mdp'] ? password_hash($_POST['mdp'], PASSWORD_DEFAULT) : null;

        if ($mdp) {
            $requete = $connexion->prepare("UPDATE utilisateurs SET first_name = ?, last_name = ?, noms = ?, roles = ?, email = ?, phone = ?, mdp = ? WHERE id = ?");
            $requete->bind_param("sssssssi", $first_name, $last_name, $noms, $roles, $email, $phone, $mdp, $id);
        } else {
            $requete = $connexion->prepare("UPDATE utilisateurs SET first_name = ?, last_name = ?, noms = ?, roles = ?, email = ?, phone = ? WHERE id = ?");
            $requete->bind_param("ssssssi", $first_name, $last_name, $noms, $roles, $email, $phone, $id);
        }

        if ($requete->execute()) {
            echo "Utilisateur mis à jour avec succès.";
        } else {
            echo "Erreur : " . $requete->error;
        }

        $requete->close();
    }

    $requete = $connexion->prepare("SELECT first_name, last_name, noms, roles, email, phone FROM utilisateurs WHERE id = ?");
    $requete->bind_param("i", $id);
    $requete->execute();
    $requete->bind_result($first_name, $last_name, $noms, $roles, $email, $phone);
    $requete->fetch();
    $requete->close();
} else {
    echo "ID d'utilisateur non fourni.";
    exit;
}

$connexion->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Utilisateur</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Modifier Utilisateur</h1>
        <form method="POST">
            <div>
                <label for="first_name">Prénom :</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" required>
            </div>
            <div>
                <label for="last_name">Nom :</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>" required>
            </div>
            <div>
                <label for="noms">Identifiant :</label>
                <input type="text" id="noms" name="noms" value="<?php echo htmlspecialchars($noms); ?>" required>
            </div>
            <div>
                <label for="roles">Rôle :</label>
                <select id="roles" name="roles" required>
                    <option value="parent" <?php if ($roles == 'parent') echo 'selected'; ?>>Parent</option>
                    <option value="teacher" <?php if ($roles == 'teacher') echo 'selected'; ?>>Enseignant</option>
                    <option value="student" <?php if ($roles == 'student') echo 'selected'; ?>>Étudiant</option>
                    <option value="direction" <?php if ($roles == 'direction') echo 'selected'; ?>>Direction</option>
                </select>
            </div>
            <div>
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div>
                <label for="phone">Téléphone :</label>
                <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required>
            </div>
            <div>
                <label for="mdp">Mot de passe (laissez vide pour ne pas changer) :</label>
                <input type="password" id="mdp" name="mdp">
            </div>
            <div>
                <button type="submit">Mettre à jour</button>
            </div>
        </form>
    </div>
</body>
</html>
