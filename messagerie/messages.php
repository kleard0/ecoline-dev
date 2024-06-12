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

// Récupération de l'ID de l'utilisateur connecté
$user_id = $_SESSION['ID'];

// Récupération des messages pour l'utilisateur connecté
$sql = "SELECT * FROM message WHERE destinataire_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie</title>
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
        <div class="sidebar">
            <div class="section-container">
                <div class="section">
                    <span class="material-symbols-outlined">menu</span>
                    <span><a href="/home.php">Accueil</a></span>
                </div>
                <div class="section">
                    <span class="material-symbols-outlined">mail</span>
                    <span><a href="index.php">Messagerie</a></span>
                </div>
                <div class="section">
                    <span class="material-symbols-outlined">calendar_today</span>
                    <span>Planning</span>
                </div>
                <div class="section">
                    <span class="material-symbols-outlined">book_2</span>
                    <span>Agenda</span>
                </div>
                <div class="section">
                    <span class="material-symbols-outlined">school</span>
                    <span>Note</span>
                </div>
                <div class="section">
                    <span class="material-symbols-outlined">shopping_bag</span>
                    <span>Gestion</span>
                </div>
                <div class="section">
                    <span class="material-symbols-outlined">restaurant</span>
                    <span>Repas</span>
                </div>
            </div>
        </div>

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
                        <h1>Messages reçus</h1>
                         
                        <a href="formulaire.php">Envoyer un message</a>
                        <a href="logout.php">Se déconnecter</a>
                        <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<div class='message'>";
                                echo "<h3>Sujet: " . htmlspecialchars($row['message_content']) . "</h3>";
                                echo "<p><a href='voir_message.php?id=" . $row['message_id'] . "'>Voir le message</a></p>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p>Aucun message reçu.</p>";
                        }
                        $stmt->close();
                        $conn->close();
                        ?>
                    </div>
                </div>
            </div>                
        </div>
    </div>
</body>
</html>
