
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reserve</title>
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
        @import url(style.css);
        @import url(reserve.css);
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    </style>
</head>

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

            
            <div class="add_section">
                <div class="field_section">
                    <form action="data_reserve1.php" method="post">
                        <div class="field">
                            <form method='POST' action='fenetre.php'>
                                <h1>Enfant(s) à choisir</h1><br>
                                <input type="checkbox" name="couleur[]" value="jaune"> Jaune<br>
                                <input type="checkbox" name="couleur[]" value="bleu"> Bleu<br>
                                <input type="checkbox" name="couleur[]" value="vert"> Vert<br>
                                <input type="checkbox" name="couleur[]" value="orange"> Orange<br>
                                <input type="checkbox" name="couleur[]" value="rouge"> Rouge<br>
                                <input type="submit" name="exple2" value="Résultats">
                                </form>
                        </div>
                        <!--
                        <div class="field"> 
                            <input name="book_name" id="book_name" type="text" placeholder="Nom du livre"/>
                        </div>
                        <div class="field">
                            <input name="book_author" id="book_author" type="text" placeholder="Auteur du livre"/>
                        </div>
                        <div class="field">
                            <input name="book_isbn" id="book_isbn" type="text" placeholder="Code ISBN"/>
                        </div> -->
                        <button type="submit">Valider</button>
                    </form>
                </div>
                <div class="button_section">
                    <div class="button">
                        <a href="/cantine/cantine-menu.php"><p>Annuler</p></a>
                        </div>
                        <!--
                    <div class="button">
                        <p>Envoyer</p>
                    -->
                    </div>
                </div>
            </div>
        
        </div>

    </div>
</body>
</html>


