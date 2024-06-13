<?php
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "ecoline_books";

// Connexion à la bdd avec mysqli
$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);
if ($connexion->connect_error) {
    die("Échec de la connexion : " . $connexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ici je récupère les données de mon formulaire et je les stock dans des variables php
    $book_id = $connexion->real_escape_string($_POST['book_ID']);
    $book_title = $connexion->real_escape_string($_POST['book_name']);
    $book_author = $connexion->real_escape_string($_POST['book_author']);
    $book_isbn = $connexion->real_escape_string($_POST['book_isbn']);

    // Vérifiez si l'entrée existe déjà
    $sql_check = "SELECT * FROM books WHERE barcode='$book_id'";
    $result = $connexion->query($sql_check);

    if ($result->num_rows > 0) {
        echo "Une entrée avec le code barre $book_id existe déjà.";
    } else {
        // Pour l'historique
        $date = date('Y-m-d');
        $bookdata = "$book_title";
        $type = "ajout";
        $requete_history = "INSERT INTO history(ID, transac_date, transac_type, bookdata) VALUES ('$book_id', '$date', '$type', '$bookdata')";
        $resultat_history = $connexion->query($requete_history);

        if (!$resultat_history) {
            die("Erreur lors de l'exécution de la requête historique : " . $connexion->error);
        }

        // Je crée et envoie ma requête avec les infos contenues dans mes variables d'avant
        $requete = "INSERT INTO books (barcode, title, is_book, genre, author, isbn, is_borrowed) VALUES ('$book_id', '$book_title', 1, 'test', '$book_author', '$book_isbn', 0)";
        $resultat = $connexion->query($requete);

        if (!$resultat) {
            die("Erreur lors de l'exécution de la requête : " . $connexion->error);
        }

        // Je redirige vers ma page menu
        header("Location: livremanuel.php");
        exit();
    }

    // Fermez la connexion à la base de données
    $connexion->close();
}
?>
