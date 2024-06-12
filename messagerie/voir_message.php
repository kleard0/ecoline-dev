<?php
// Démarrer la session
session_start();

$servername = "localhost";
$username = "message";
$password = "4VZzATv&jiCV5Jo*5m5i@!X^#PbK9ijx";
$dbname = "ecoline";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupération de l'ID du message à afficher
$message_id = $_GET['id'];

// Récupération du message correspondant
$sql = "SELECT * FROM message WHERE message_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $message_id);
$stmt->execute();
$result = $stmt->get_result();

// Affichage du message
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Aucun message trouvé.";
    exit();
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voir le message</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style type="text/css">
        @import url(style.css);
        @import url(sidebar.css);
        @import url(formulaire.css); 
    </style>
</head>
<body>
    <div class="container-all">
        <div class="main">
            <div class="head">
                <div class="logo-block">
                    <img src="image/logo-ecoline.png">
                </div>
                <div class="name-box"></div>
            </div>
            <div class="main-container">
                <div class="container">
                    <div class="view-message">
                        <h1>Sujet: <?php echo htmlspecialchars($row['message_content']); ?></h1>
                        <p><?php echo nl2br(htmlspecialchars($row['message_text'])); ?></p>
                        <?php
                        if (!empty($row['message_media'])) {
                            echo "<p><a href='" . htmlspecialchars($row['message_media']) . "'>Voir la pièce jointe</a></p>";
                        }
                        ?>
                        <a href="messages.php">Retour à la messagerie</a>
                    </div>
                </div>
            </div>                
        </div>
    </div>
</body>
</html>
