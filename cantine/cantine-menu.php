<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecoline</title> <!-- liste pour les icons  -->
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
        @import url(../components/sidebar.php);
        @import url(../../components/sidebar.css);
        @import url(style-cantine-menu.css);
        @import url(../sidebar.css);
        @import url(../icons.css);
        @import url(cantine-menu.css);
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    </style>
</head>
<?php

?>
<body>
    <div class="container-all">
        <?php include '../components/sidebar.php'; ?>

        <div class="main">
            <div class="head"> 
                <div class="logo-block"> <!-- class pour l'en-tête -->
                    <img src="/image/logo-ecoline.png">
                </div>
                <div class="name-box"> 
                </div>
            </div>
            <div class="page-title">
                <h1>Menu de Cantine</h1>
            </div>
            <div class="main-container"> <!-- class pour les containers -->
                <div class="container">
                <br><br><br><br><br><br>
                <a href="/cantine/cantine-appel.php">
                <span>Gérer l'appel</span>
                </a>
                </div>

                <div class="container">
                    <br><br><br><br><br>
                    <a href="/cantine/reserve.php">
                    <span>Faire/consulter une Réservation</span>
                    </a>
                </div>        
                <div class="container">
                    <br><br><br><br><br><br>
                    <a href="/cantine/cantine-historique.php">
                    <span>Historique de présence</span>
                    </a>
                </div>
                



            </div>                
        </div>

    </div>

</body>
</html>


