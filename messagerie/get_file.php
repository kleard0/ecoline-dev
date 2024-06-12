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

// Récupération du fichier blob et de son nom depuis la base de données
$sql = "SELECT message_media, name_extension, name_file FROM message WHERE message_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $message_id);
$stmt->execute();
$stmt->store_result();

// Vérifie si un enregistrement est trouvé
if ($stmt->num_rows > 0) {
    $stmt->bind_result($media_blob, $extension, $file_name);
    $stmt->fetch();
    $stmt->close();

    // Ajouter un point (.) entre le texte de "name_file" et l'extension
    $file_name_with_extension = $file_name . "." . $extension;

    // Envoi des en-têtes HTTP appropriés pour indiquer le type de contenu
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=" . $file_name_with_extension);
    header("Content-Length: " . strlen($media_blob));

    // Affichage du contenu du blob
    echo $media_blob;
} else {
    // Si aucun enregistrement n'est trouvé, affiche un message d'erreur
    echo "Fichier non trouvé.";
}
$conn->close();
?>
