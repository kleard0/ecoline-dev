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
        @import url(historique.css);
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

$requete_history = "SELECT * FROM history ";
$resultat_history = $connexion->query($requete_history);


$donnees_history = array();
while ($ligne_history = $resultat_history->fetch_assoc()) {
    $donnees_history[] = $ligne_history;
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
                    <div class="history_shortcut">
                        <div class="history_header">
                             <h1> Dernières transactions </h1>
                             <a href="livremanuel.php"><button> Retour</button></a>
                        </div>
                        
                        
                        <table class="mystock_table">
                            <tr>
                                <th>ID </th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Information</th>
                            </tr>
                        <?php
                            foreach ($donnees_history as $ligne_history) {
                                echo "<tr>";
                                foreach ($ligne_history as $valeur_history) {
                                    echo "<td>" . $valeur_history . "</td>";
                                }
                                echo "</tr>";
                            }
                        ?>
                        </table>
                       
                        
                    </div>
                    
                </div>
        </div>     
</body>
</html>