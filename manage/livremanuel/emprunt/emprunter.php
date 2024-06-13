<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des livres et manuels</title>
    <link rel="icon" href="favicon.ico" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap">
    <style type="text/css">
        @import url(../../../components/sidebar.php);
        @import url(../../../components/sidebar.css);
        @import url(../../icons.css);
        @import url(../../style.css);
        @import url(emprunter.css);
    </style>
</head>
<body>
<?php
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "ecoline_books";

$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);
if ($connexion->connect_error) {
    die("Échec de la connexion : " . $connexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $connexion->real_escape_string($_POST['book_id']);
    $users_id = $connexion->real_escape_string($_POST['users_id']);
    $date = date('Y-m-d H:i:s');  
    $state = $connexion->real_escape_string($_POST['state']);

    // Requête pour vérifier que le livre et l'emprunteur existent bien dans la base de données
    $verif_books = "SELECT COUNT(*) as count FROM books WHERE barcode = '$book_id'";
    $verif_users = "SELECT COUNT(*) as count FROM users WHERE barcode = '$users_id'";
    
    $requete_verifBooks = $connexion->query($verif_books);
    $requete_verifUsers = $connexion->query($verif_users);
    
    $verif_books = $requete_verifBooks->fetch_assoc();
    $verif_users = $requete_verifUsers->fetch_assoc();

    if ($verif_books['count'] > 0 && $verif_users['count'] > 0) {
        // Insérer dans la table emprunts
        $requete = $connexion->prepare("INSERT INTO emprunts(users_id, books_id, emprunt_date, state) VALUES (?, ?, ?, ?)");
        $requete->bind_param("iiss", $users_id, $book_id, $date, $state);
        $requete->execute();

        if ($requete->error) {
            echo "Erreur lors de l'exécution de la requête : " . $requete->error;
        } else {
            echo "L'emprunt a été enregistré avec succès.";
        }
    } else {
        echo "Erreur : l'utilisateur ou le livre n'existe pas.";
    }
}
?>
<div class="container-all">
    <?php include '../../../components/sidebar.php'; ?>
    <div class="emprunter">
        <h1> Emprunter un livre</h1>
        <form method="post">
            <input name="book_id" id="book_id" type="text" placeholder="ID du livre emprunté" required/>
            <input name="users_id" id="users_id" type="text" placeholder="ID de l'emprunteur" required/>
            <input name="state" id="state" type="text" placeholder="État actuel du livre" required/>
            <button type="submit">Valider</button>
            <button><a href="../emprunts.php">Retour</a></button>
        </form>
    </div>    
</div>
</body>
</html>
