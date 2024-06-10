<?php
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "ecoline";

$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

if ($connexion->connect_error) {
    die("Échec de la connexion : " . $connexion->connect_error);
}

$utilisateurs = [
    ['eleve', 'mdpeleve', 1],
    ['parent', 'mdpparent', 2],
    ['prof', 'mdpprof', 3],
    ['direction', 'mdpdirection', 4],
];

foreach ($utilisateurs as $utilisateur) {
    $nom = $utilisateur[0];
    $mdp = password_hash($utilisateur[1], PASSWORD_DEFAULT);
    $role = $utilisateur[2];

    $requete = $connexion->prepare("INSERT INTO utilisateurs (names, passwords, roles) VALUES (?, ?, ?)");
    $requete->bind_param("ssi", $nom, $mdp, $role);
    $requete->execute();
    $requete->close();
}

$connexion->close();
echo "Utilisateurs ajoutés avec succès";
?>
