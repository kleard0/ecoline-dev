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

// Mettre à jour le statut du message pour indiquer qu'il a été lu
$update_sql = "UPDATE message SET view_message = 1 WHERE message_id = ?";
$update_stmt = $conn->prepare($update_sql);
$update_stmt->bind_param("i", $message_id);
$update_stmt->execute();
$update_stmt->close();

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
        
        .media-button {
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            display: <?php echo !empty($row['message_media']) ? 'inline-block' : 'none'; ?>; /* Affichage conditionnel du bouton */
        }
        .media-button:hover {
            background-color: #0056b3;
        }
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
                            // Créer une URL vers le script PHP qui renvoie le contenu du fichier BLOB
                            $file_src = 'get_file.php?id=' . $message_id;
                            echo "<a href='" . $file_src . "' class='media-button' download>Télécharger la piece jointe</a>";
                            echo "<p>Nom du fichier : " . htmlspecialchars($row['name_file']) . "." . htmlspecialchars($row['name_extension']) . "</p>";
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
