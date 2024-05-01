<?php

$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "ecoline_livremanuel";

// Connexion à la bdd avec mysqli
$connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);
if (!$connexion) {
    die("Échec de la connexion : " . mysqli_connect_error());
}


// Ici je récupère les données de mon formulaire et je les stock dans des variables php
$book_id = mysqli_real_escape_string($connexion, $_POST['book_ID']);
$book_title = mysqli_real_escape_string($connexion, $_POST['book_name']);
$book_author = mysqli_real_escape_string($connexion, $_POST['book_author']);
$book_isbn = mysqli_real_escape_string($connexion, $_POST['book_isbn']);

// Pour l'historique
$date = date('d-m-y h:i:s');
$addID = "add" . "$book_title" ."$date";
$bookdata = "$book_title" . "$book_author" ."$book_isbn"; 
$type = "add";
$requete_history = "INSERT INTO history(ID, Date, Type, BookData) VALUES ('$addID', '$date', '$type', '$bookdata')";
$connexion->query($requete_history);

// Je crée et envoie ma requette avec les info contenu dans mes variables d'avant
$requete = "INSERT INTO books (barcode, title, is_book, genre, isbn, is_borrowed, author) VALUES ('$book_id', '$book_title', 1, 'test', '$book_isbn', 0, '$book_author')";
$resultat = $connexion->query($requete);

if (!$resultat) {
    die("Erreur lors de l'exécution de la requête : " . $connexion->error);
}

// Je redirige vers ma page menu
header("Location: livremanuel.php");
exit();
?>
