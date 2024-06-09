<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des utilisateurs</title>
</head>
<body>
    <h2>Liste des utilisateurs</h2>
    <?php
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

    // Préparer et exécuter la requête pour récupérer toutes les informations des utilisateurs
    $sql = "SELECT user_id, first_name, last_name, username, email, phone, account_type FROM utilisateur";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID Utilisateur</th><th>Prénom</th><th>Nom</th><th>Nom d'utilisateur</th><th>Email</th><th>Téléphone</th><th>Type de compte</th></tr>";
        // Afficher les données de chaque ligne
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["user_id"]. "</td>
                    <td>" . $row["first_name"]. "</td>
                    <td>" . $row["last_name"]. "</td>
                    <td>" . $row["username"]. "</td>
                    <td>" . $row["email"]. "</td>
                    <td>" . $row["phone"]. "</td>
                    <td>" . $row["account_type"]. "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "0 résultats";
    }

    // Fermer la connexion
    $conn->close();
    ?>

    <br>
    <form action="index.php" method="get">
        <input type="submit" value="Retour à l'accueil">
    </form>
</body>
</html>
