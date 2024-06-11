<?php
session_start();

if (!isset($_SESSION['ID'])) {
    header("Location: login.php");
    exit;
}
else {
    header("Location: messages.php");
}

$roles = $_SESSION['roles'];
$message = "";

switch ($roles) {
    case 1:
        $message = "Bienvenue, Élève";
        break;
    case 2:
        $message = "Bienvenue, Parent";
        break;
    case 3:
        $message = "Bienvenue, Professeur";
        break;
    case 4:
        $message = "Bienvenue, Direction";
        break;
    default:
        $message = "Bienvenue";
        break;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            max-width: 400px;
            margin: 100px auto;
            text-align: center;
        }

        h1 {
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $message; ?></h1>
        <p>Ceci est la page de gestion.</p>
    </div>
</body>
</html>
