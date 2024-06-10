<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
</head>
<body>
    <h1>Bienvenue, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
    <p>Vous êtes connecté en tant que <?php echo htmlspecialchars($_SESSION['account_type']); ?>.</p>

    <?php if ($_SESSION['account_type'] === 'eleve') : ?>
        <p>Message pour les élèves.</p>
    <?php elseif ($_SESSION['account_type'] === 'parent') : ?>
        <p>Message pour les parents.</p>
    <?php elseif ($_SESSION['account_type'] === 'enseignant') : ?>
        <p>Message pour les professeurs.</p>
    <?php elseif ($_SESSION['account_type'] === 'direction') : ?>
        <p>Message pour la direction.</p>
    <?php endif; ?>

    <a href="logout.php">Se déconnecter</a>
</body>
</html>
