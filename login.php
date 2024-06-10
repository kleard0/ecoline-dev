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
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Préparer et exécuter la requête SQL pour vérifier les identifiants
    $stmt = $conn->prepare("SELECT user_id, username, password, account_type FROM Utilisateurs WHERE username = ?");
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $db_username, $db_password, $account_type);
        $stmt->fetch();

        if (password_verify($password, $db_password)) {
            // Stocker les informations de l'utilisateur dans la session
            $_SESSION['userid'] = $user_id;
            $_SESSION['username'] = $db_username;
            $_SESSION['account_type'] = $account_type;
            setcookie('username', $username, time() + 3600, '/'); // Cookie valide pendant 1 heure (3600 secondes)

            header("Location: welcome.php");
            exit();
        } else {
            echo "Mot de passe incorrect, veuillez réessayer.";
        }
    } else {
        echo "Nom d'utilisateur introuvable, veuillez réessayer.";
    }

    $stmt->close();
}

$conn->close();
?>
