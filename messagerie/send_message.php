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
    $user_id = $_SESSION['ID']; // Expéditeur
    $destinataire_id = $_POST['destinataire_id']; // Destinataire
    $message_content = $_POST['message_content'];
    $message_text = $_POST['message_text'];

    // Gestion de l'upload de fichier
    if (!empty($_FILES['message_media']['name'])) {
        $file_name = $_FILES['message_media']['name'];
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_base_name = pathinfo($file_name, PATHINFO_FILENAME);
        $file_size = $_FILES['message_media']['size'];
        $message_media = file_get_contents($_FILES['message_media']['tmp_name']); // Contenu du fichier

        // Vérifiez la taille du fichier côté serveur (16MB = 16777216 bytes)
        if ($file_size > 16777216) {
            echo "Le fichier est trop grand. La taille maximale autorisée est de 16 MB.";
            exit;
        }

        // Insérez le contenu du fichier, le nom et l'extension dans la base de données
        $sql = "INSERT INTO message (user_id, destinataire_id, message_content, message_text, message_media, name_file, name_extension) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iisssss", $user_id, $destinataire_id, $message_content, $message_text, $message_media, $file_base_name, $file_extension);

        if ($stmt->execute()) {
            echo "<div>Message envoyé. Vous serez redirigé dans 2 secondes...</div>";
            echo "<script>
                    setTimeout(function(){
                        window.location.href = 'messages.php';
                    }, 2000);
                  </script>";
        } else {
            echo "Erreur: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
    }
}
$conn->close();
?>
