<?php

// Informations de connexion à la base de données
$serveur = "localhost";
$utilisateur = "messagerie";
$motdepasse = "mot_de_passe";
$base_de_donnees = "test";

// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);

// Vérification de la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

// Texte à insérer dans la base de données
$texte = "Bonjour, monde!";

// Requête d'insertion
$sql = "INSERT INTO HelloWorld (texte) VALUES ('$texte')";

// Exécution de la requête
if ($connexion->query($sql) === TRUE) {
    echo "Texte inséré avec succès dans la base de données.";
} else {
    echo "Erreur lors de l'insertion du texte : " . $connexion->error;
}

// Fermeture de la connexion à la base de données
$connexion->close();

?>