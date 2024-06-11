<?php
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['ID'];
    $destinataire_id = $_POST['destinataire_id'];
    $message_content = $_POST['message_content'];
    $message_text = $_POST['message_text'];
    $message_media = "";

    // Gestion de l'upload de fichier
    if (!empty($_FILES['message_media']['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["message_media"]["name"]);
        if (move_uploaded_file($_FILES["message_media"]["tmp_name"], $target_file)) {
            $message_media = $target_file;
        }
    }

    $sql = "INSERT INTO message (user_id, destinataire_id, message_content, message_text, message_media) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisss", $user_id, $destinataire_id, $message_content, $message_text, $message_media);

    if ($stmt->execute()) {
        echo "Message envoyé avec succès.";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}
$conn->close();
?>
