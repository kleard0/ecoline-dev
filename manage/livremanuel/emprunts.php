<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des livres et manuels</title>
    <link rel="icon" href="favicon.ico" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style type="text/css">
        @import url(../../components/sidebar.php);
        @import url(../../components/sidebar.css);
        @import url(../../icons.css);
        @import url(../../style.css);
        @import url(emprunts.css);
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    </style>
</head>
<?php
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "ecoline_books";

$connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);
if (!$connexion) {
    die("Échec de la connexion : " . mysqli_connect_error());
}


?>
<body>
    <div class="container-all">
          <?php include '../../components/sidebar.php'; ?>
    
        <div class="emprunts">
            <div class="emprunter_button"> <a href="emprunt/emprunter.php">Emprunter  </a></div>
            <div class="rendre_button"><a href="emprunt/rendre.php">Rendre  </a></div> 
            <div class="manage_button"><a href="emprunt/emprunts_manage.php">Gérer </a></div>     
        </div>
        
    </div>

   

</body>
</html>


