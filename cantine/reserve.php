
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
<?php
//php login
    $host = "localhost";
    $user = "root";
    $password = "";
    $bdd = "ecoline_reservation";

    $connect = new mysqli($host, $user, $password, $bdd);
    if (!$connect) {die("Échec de la connexion : " . mysqli_connect_error());}

    //data de BDD
 /*
    $req_parents = "SELECT * FROM parent where parent_id = '".$parent_id."' ";
    $result_parents=$connect->query($req_parents);
 
    $req_enfants = "SELECT * FROM student INNER JOIN p_s ON p_s.s_id = student.student_id WHERE p_s.p_id = '".$parent_id."' " ;
    $result_enfants=$connect->query($req_enfants);

    $data_parents = array();
    while ($row = $result_parents->fetch_assoc()) {
        $data_parents[] = $row_parents;}

    $date_enfants = array();
    while ($row = $result_enfants->fetch_assoc()) {
        $date_enfants[] = $row_enfants;}
*/
?>
 <!--this can be put in a function file -->

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
                                <input name="parent_ID" id="parent_ID" type="number" placeholder="Parent ID" required/>
                            <!-- required est pour obliger de saisir des valeurs -->
                            </div>
               
                                <button type="submit">Valider</button>
                        </form>
            </div>
                <div class="button_section">
                    <div class="button">
                        <a href="/cantine/cantine-menu.php"><p>Annuler</p></a>
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
             <?php
            /*
             $row=mysqli_fetch_array($result_enfants);
             if ($result_enfants->num_rows > 0) {
                 // output data of each row
                 // row 0: ID --- row 1: first name --- row2: last name 
             echo nl2br ("liste d'enfants : \n $row[0] : '$row[1] $row[2]'") ; 

         }
*/
        ?> </div>

                </div> <!--- end of main --->

            <div class="student_list">
            
            </div>
        </div>

    </div>
</body>
</html>
