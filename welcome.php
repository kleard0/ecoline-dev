<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: login.html");
    exit();
}
// Après une connexion réussie
$username = $_POST['username']; // Supposons que le nom d'utilisateur a été saisi via un formulaire
setcookie('username', $username, time() + 3600, '/'); // Cookie valide pendant 1 heure (3600 secondes)

// Attendre une seconde avant la redirection
sleep(1);

// Redirige vers home.php après le délai
header("Location: home.php");
exit();
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirection en cours...</title>
</head>
<body>
    <p>Si vous n'êtes pas redirigé immediatement, cliquer </p><a href="home.php">ici</a>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>