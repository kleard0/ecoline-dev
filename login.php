<?php
session_start();

$servername = "localhost";
$dbusername = "message";
$dbpassword = "4VZzATv&jiCV5Jo*5m5i@!X^#PbK9ijx";
$dbname = "ecoline";

// Connexion à la base de données
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $noms = trim($_POST['noms']);
    $mdp = trim($_POST['mdp']);

  

    // Préparer et exécuter la requête SQL pour vérifier les identifiants
    $stmt = $conn->prepare("SELECT id, noms, mdp FROM utilisateurs WHERE noms = ?");
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("s", $noms);
    $stmt->execute();
    $stmt->store_result();

    // Debugging: Vérifiez le nombre de lignes trouvées
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $db_noms, $db_mdp);
        $stmt->fetch();



        // Vérifier le mot de passe en clair
        if ($mdp === $db_mdp) {
            // Stocker les informations de l'utilisateur dans la session
            $_SESSION['id'] = $id;
            $_SESSION['noms'] = $db_noms;
            setcookie('noms', $noms, time() + 3600, '/'); // Cookie valide pendant 1 heure (3600 secondes)

            header("Location: welcome.php");
            exit();
        } else {
            echo "Mot de passe incorect, veuillez réessayer.";
        }
    } else {
        echo "Nom d'utilisateur introuvable, veuillez réessayer.";
    }

    $stmt->close();
}

$conn->close();
?>
<html><a href="index.html">Retour</a></html>