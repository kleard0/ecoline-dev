<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire d'inscription</title>
</head>
<body>
    <h2>Inscription</h2>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $servername = "localhost";
        $username = "message";
        $password = "4VZzATv&jiCV5Jo*5m5i@!X^#PbK9ijx";
        $dbname = "ecoline";

        // Créer une connexion
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Récupérer les données du formulaire
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $account_type = $_POST['account_type'];

        // Préparer et lier
        $stmt = $conn->prepare("INSERT INTO utilisateur (first_name, last_name, username, email, phone, password, account_type) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $first_name, $last_name, $username, $email, $phone, $password, $account_type);

        // Exécuter la requête
        if ($stmt->execute()) {
            echo "Nouvel enregistrement créé avec succès";
    
        } else {
            echo "Erreur: " . $stmt->error;
        }

        // Fermer la connexion
        $stmt->close();
        $conn->close();
    }
    ?>

    <form action="" method="post">
        <label for="first_name">Prénom:</label>
        <input type="text" id="first_name" name="first_name" required><br><br>

        <label for="last_name">Nom:</label>
        <input type="text" id="last_name" name="last_name" required><br><br>

        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone">Téléphone:</label>
        <input type="tel" id="phone" name="phone" required><br><br>

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="account_type">Type de compte:</label>
        <select id="account_type" name="account_type" required>
            <option value="parent">Parent</option>
            <option value="teacher">Enseignant</option>
            <option value="student">Eleve</option>
            <option value="direction">Direction</option>
        </select><br><br>

        <input type="submit" value="S'inscrire">
    </form>
    
    <br>
    <form action="index.php" method="get">
        <input type="submit" value="Retour">
    </form>
</body>
</html>
