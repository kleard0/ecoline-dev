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
    ['eleve', 'mdpeleve', 'eleve'],
    ['parent', 'mdpparent', 'parent'],
    ['prof', 'mdpprof', 'prof'],
    ['direction', 'mdpdirection', 'direction'],
];

foreach ($utilisateurs as $utilisateur) {
    $username = $utilisateur[0];
    $password = password_hash($utilisateur[1], PASSWORD_BCRYPT);
    $account_type = $utilisateur[2];

    $requete = $connexion->prepare("INSERT INTO Utilisateurs (family_id, first_name, last_name, username, account_type, email, phone, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $requete->bind_param("isssssss", $family_id, $first_name, $last_name, $username, $account_type, $email, $phone, $password);
    $family_id = rand(1, 10000); // Exemple de family_id
    $first_name = 'Prenom'; // Exemple de prénom
    $last_name = 'Nom'; // Exemple de nom
    $email = 'email@example.com'; // Exemple d'email
    $phone = '0123456789'; // Exemple de numéro de téléphone
    $requete->execute();
    $requete->close();
}

$connexion->close();
echo "Utilisateurs ajoutés avec succès";
?>
