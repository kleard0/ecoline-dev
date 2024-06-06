<?php
// Connexion à la base de données
$servername = "localhost";
$username = "message";
$password = "4VZzATv&jiCV5Jo*5m5i@!X^#PbK9ijx";
$dbname = "ecoline";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $mot_de_passe = $_POST["mot_de_passe"];

    // Valider et insérer les données dans la base de données
    $sql = "INSERT INTO utilisateur (user_id, firstlast_name, username) VALUES ('$nom', '$numero', '$mot_de_passe')";

    if ($conn->query($sql) === TRUE) {
        echo "Utilisateur ajouté avec succès";
    } else {
        echo "Erreur lors de l'ajout de l'utilisateur: " . $conn->error;
    }
}

// Fermer la connexion
$conn->close();
?>


Ajouter un nouvel utilisateur

<form action="ajouter-utilisateur.php" method="POST">
    <label for="nom">Nom:</label>
    <input type="text" name="nom" id="nom" required><br>

    <label for="numero">ID:</label>
    <input type="number" name="numero" id="numero" required><br>

    <label for="mot_de_passe">Mot de passe:</label>
    <input type="password" name="mot_de_passe" id="mot_de_passe" required><br>

    <input type="submit" value="Ajouter">
</form>

