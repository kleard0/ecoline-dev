<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des materiels</title>
    <link rel="icon" href="favicon.ico" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style type="text/css">
        @import url(../sidebar.css);
        @import url(../style.css);
        @import url(../icons.css);
        @import url(materiel.css);
        @import url(../components/sidebar.css);
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    </style>
</head>

<body>
    <div class="container-all">
        <div class="sidebar">
            <div class="section-container">
                <div class="section">
                    <a href="index.html">
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
                    <a href="manage/manage.html">
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
                <div class="menu_container">
                <?php
                session_start();

                    if (!isset($_SESSION['ID'])) {
                        header("Location: login.php");
                        exit;
                    }
                    
                    $roles = $_SESSION['roles'];
                    if ($roles !== 1 && $roles !==2)
                    {
                        echo'<div class="container">
                            <a href="./ajout.php">
                                <h1>Ajouter un materiel</h1>
                            </a>
                        </div>';
                    }

                    if (!isset($_SESSION['ID'])) {
                        header("Location: login.php");
                        exit;
                    }
                    
                    $roles = $_SESSION['roles'];
                    if ($roles !== 1 && $roles !== 2)
                    {
                        echo'<div class="container">
                        <a href="./voir_stock.php">
                            <h1 class="voir_stock">Voir le stock</h1>
                        </a>
                    </div>';
                    }

                    if (!isset($_SESSION['ID'])) {
                        header("Location: login.php");
                        exit;
                    }
                    
                    $roles = $_SESSION['roles'];
                    if ($roles !== 1 && $roles !== 2 && $roles !== 3)
                    {
                        echo'<div class="container">
                        <a href="./supprimer.php">
                            <h1>Supprimer un materiel</h1>
                        </a>
                    </div>';
                    }

                    if (!isset($_SESSION['ID'])) {
                        header("Location: login.php");
                        exit;
                    }
                    
                    $roles = $_SESSION['roles'];
                    if ($roles !== 1 && $roles !== 2)
                    {
                        echo'<div class="container">
                        <a href="./modifier.php">
                            <h1>Modifier un materiel</h1>
                        </a>
                    </div>';
                    }

                    if (!isset($_SESSION['ID'])) {
                        header("Location: login.php");
                        exit;
                    }
                    
                    $roles = $_SESSION['roles'];
                    if ($roles !== 1)
                    {
                        echo'<div class="container">
                        <a href="./reservation.php">
                            <h1>Reserver un matériel</h1>
                        </a>
                    </div>';
                    }
                    ?>
                    <div class="container">
                        <a href="./historique.php">
                            <h1>Historique</h1>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </main>                
        </div>

    </div>
</body>
</html>


