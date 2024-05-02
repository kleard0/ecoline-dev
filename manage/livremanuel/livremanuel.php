<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des livres et manuels</title>
    <link rel="icon" href="favicon.ico" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style type="text/css">
        @import url(../../sidebar.css);
        @import url(../../style.css);
        @import url(../../icons.css);
        @import url(livremanuel.css);
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    </style>
</head>
<?php
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "ecoline_livremanuel";

$connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);
if (!$connexion) {
    die("Échec de la connexion : " . mysqli_connect_error());
}


$requete_books = "SELECT * FROM books";
$resultat_books = $connexion->query($requete_books);
$requete_history = "SELECT * FROM history";
$resultat_history = $connexion->query($requete_history);


$donnees_books = array();
while ($ligne_books = $resultat_books->fetch_assoc()) {
    $donnees_books[] = $ligne_books;
}
$donnees_history = array();
while ($ligne_history = $resultat_history->fetch_assoc()) {
    $donnees_history[] = $ligne_history;
}


?>
<body>
    <div class="container-all">
        <div class="sidebar">
            <div class="section-container">
                <div class="section">
                    <a href="../index.html">
                    <span class="material-symbols-outlined">
                        menu
                        </span>
                        <span > Accueil</span>
                    </a>   
                </div>

                <div class="section">
                    <span class="material-symbols-outlined">
                        mail
                        </span>
                        <span> Messagerie</span>
                </div>
                <div class="section">
                    <span class="material-symbols-outlined">
                        calendar_today
                        </span>
                        <span> Planning</span>
                </div>
                <div class="section">
                    <span class="material-symbols-outlined">
                        book_2
                        </span>
                        <span> Agenda</span>
                </div>
                <div class="section">
                    <span class="material-symbols-outlined">
                        school
                        </span>
                        <span>Note</span>
                </div>
                <div class="section">
                    <a href="/manage/manage.html">
                    <span class="material-symbols-outlined">
                        shopping_bag
                        </span>
                        <span class="title">Gestion</span>
                    </a>    
                </div>
                <div class="section">
                    <a href="/cantine/cantine.html">
                        <span class="material-symbols-outlined">
                        restaurant
                        </span>
                        <span> Cantine</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="main">
            <div class="head">
                <div class="logo-block">
                    <img src="/image/logo-ecoline.png">
                </div>
                <div class="name-box">
                </div>
            </div>
            <div class="manage_menu">
                <div class="navigation">
                    <div class="add"> <a href="add.html"><h1>Ajouter </h1></a></div>
                    <div class="hystory"> <a href="historique.php"><h1>Historique </h1> </a></div>
                    <div class="mystock"><a href="stock.php"><h1>Mon stock </h1> </a></div>
                </div>
               <div class="me">
                    <div class="history_shortcut">
                    <h1> Dernières transactions </h1>
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
                    <div class="mystock_shortcut">
                        <h1> Mes livres </h1>
                        <table class="mystock_table">
                            <tr>
                                <th>ID </th>
                                <th>Nom</th>
                                <th>Livre/Manuel</th>
                                <th>Genre</th>
                                <th>ID Elève</th>
                                <th>ID Elève</th>
                                <th>Autheur</th>
                            </tr>
                        <?php
                            foreach ($donnees_books as $ligne_books) {
                                echo "<tr>";
                                foreach ($ligne_books as $valeur_books) {
                                    echo "<td>" . $valeur_books . "</td>";
                                }
                                echo "</tr>";
                            }
                        ?>
                    </table>
                    </div>
                    </div>
               </div>
            </div>
        
        </div>

        </div>
                          
        </div>

    </div>

</body>
</html>


