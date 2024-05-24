<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique </title>
    <link rel="icon" href="favicon.ico" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style type="text/css">
        @import url(../../components/sidebar.php);
        @import url(../../components/sidebar.css);
        @import url(../../style.css);
        @import url(../../icons.css);
        @import url(mystock.css);
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    </style>
</head>
<?php
// Identifiant de connexion à la BDD
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "ecoline_books";

// COnnexion à la BDD avec les identificiant 
$connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);
if (!$connexion) {
    die("Échec de la connexion : " . mysqli_connect_error());
}
// Requete de récupérer des données 
$requete_books = "SELECT * FROM books ";
$resultat_books = $connexion->query($requete_books);



$donnees_books = array(); // Crée un tableau vide pour stocker les données des livres

while ($ligne_books = $resultat_books->fetch_assoc()) {
    // Exécute une boucle tant qu'il y a des lignes à lire dans le résultat de la requête
    $donnees_books[] = $ligne_books; // Ajoute chaque ligne (livre) récupérée au tableau $donnees_books
}



?>
<body>
        <div class="container-all">
                <?php include '../../components/sidebar.php'; ?>
            
                <div class="main">
                    <div class="head">
                        <div class="logo-block">
                            <img src="/image/logo-ecoline.png">
                        </div>
                    </div>
                    <div class="mystock_shortcut">
                    <h1> Mes livres </h1>
                    <table class="mystock_table">
    <tr>
        <th>ID </th>
        <th>Nom</th>
        <th>Livre/Manuel</th>
        <th>Genre</th>
        <th>ID Elève</th>
        <th>ID Elève</th> <!-- Duplication de la colonne 'ID Elève', probablement une erreur. -->
        <th>Auteur</th> <!-- 'Autheur' corrigé en 'Auteur' -->
    </tr>
    <?php
    // Boucle sur chaque ligne de données, chaque ligne représentant un livre ou un manuel.
    foreach ($donnees_books as $ligne_books) {
        echo "<tr>"; // Début d'une nouvelle ligne dans la table pour chaque livre
        // Boucle sur chaque valeur de la ligne courante (livre), chaque valeur correspondant 
        //à une cellule (td) dans la ligne de table
        foreach ($ligne_books as $valeur_books) {
            echo "<td>" . $valeur_books . "</td>"; // Crée une cellule de table avec la valeur actuelle
        }
        echo "</tr>"; // Fin de la ligne de table
    }
    ?>
</table>

                        ?>
                    </table>
                        
                    </div>
                    
                </div>
        </div>     
</body>
</html>