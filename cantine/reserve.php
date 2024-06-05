<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reserve</title>
    <link rel="icon" href="favicon.ico" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet"
href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style type="text/css">
        @import url(../components/sidebar.php);
        @import url(../../components/sidebar.css);
        @import url(../../sidebar.css);
        @import url(../../style.css);
        @import url(../../icons.css);
        @import url(style.css);
        @import url(sql_login.php);
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    </style>
</head>

<?php include 'sql_login.php'; ?>

<body>
    <div class="container-all">
       <?php include '../components/sidebar.php'; ?>

        <div class="main"> <!--- start of main --->
            <div class="head">
                <div class="logo-block">
                    <img src="/image/logo-ecoline.png">
                </div>
                <div class="name-box">
                </div>
            </div>


            <div class="add_section">
                <div class="field_section">
                    <form action="/cantine/reserve2.php" method="post">
                        <!-- # pour récuperer le data depuis ce programme
                            sinon mettre le nom d'autre fichier-->
                        <div class="field">
                            <label for="ID">ID de Parent :</label>
                            <input name="parent_id" id="parent_id" type="number" placeholder="Parent ID" required />
                            <!-- required est pour obliger de saisir des valeurs -->
                        </div>

                        <button type="submit">Valider</button>
                    </form>
                </div>
                <div class="button_section">
                    <div class="button">
                        <a href="/cantine/cantine-menu.php">
                            <p>Annuler</p>
                        </a>
                    </div>
                    <!-- <div class="button">
                           <p>Envoyer</p> -->
                </div>
            </div>
            <br>
            <div class="parent_name">

                <!--
             <table class="table table-hover" >
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">First Name</th>
                  <th scope="col">Last Name</th>
                </tr>
            -->
            </div> <!--- end of main --->
        </div>

    </div>
</body>

</html>