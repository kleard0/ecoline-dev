<!--Ecoline-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <!--Meta-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Messagerie</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
    
    <!--Icon font Google-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!--CSS-->
    <style type="text/css">
        @import url(style.css); 
        @import url(sidebar.css);
        @import url(/icons.css);
        @import url(admin.css);

    h1 {
    text-align: center;
    }
    </style>
    
</head>
<!--Body-->
<body>
    <div class="container-all">
        <!--Sidebar-->
        <div class="sidebar">
            <div class="section-container">
                <div class="section">
                    <span class="material-symbols-outlined">
                        menu
                        </span>
                        <span><a href="/home.php">Accueil</a>
                </div>
                <div class="section">
                    <span class="material-symbols-outlined">
                        mail
                        </span>
                        <span><a href="/messagerie/index.php">Messagerie</a>
                        </span>
                </div>
                <div class="section">
                    <span class="material-symbols-outlined">
                        calendar_today
                        </span>
                        <span>Planning</span>
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
                        <span>‎ Note</span>
                </div>
                <div class="section">
                    <span class="material-symbols-outlined">
                        shopping_bag
                        </span>
                        <span>Gestion</span>
                </div>
                <div class="section">
                    <span class="material-symbols-outlined">
                        restaurant
                        </span>
                        <span><a href="/cantine/cantine-menu.php">Cantine</a></span>
                </div>
            </div>
        </div>
        <p style="font-family:Arial">
        <div class="main">
            <div class="head">
                <div class="logo-block">
                    <img src="/image/logo-ecoline.png">
                </div>
                <div class="name-box">
                </div>
            </div>
            <div class="main-container">
                <div class="container">
                    <h1 style="font-family:Arial, Helvetica, sans-serif ";>Admistration utilisateurs</h1>
                 


                    <div class="manage_menu">
                <div class="menu_container">
                    <div class="container">
                        <a href="ajouter-utilisateur.php">
                            <h1>Ajouter un utilisateur</h1>
                        </a>
                    </div>
                    <div class="container">
                        <a href="liste-utilisateur.php">
                            <h1>Voir la liste des utilisateurs</h1>
                        </a>
                    </div>
                    <div class="container">
                        <a href="modifier-utilisateur.php">
                            <h1>Modifier un utilisateur</h1>
                        </a>
                    </div>
                    <div class="container">
                        <a href="supprimer-utilisateur.php">
                            <h1>Supprimer un utilisateur</h1>
                        </a>
                    </div>
                 
                </div>
            </div>



                 
                   

                </div>

            </div>                
        </div>

    </div>
    
</body>
</html>
