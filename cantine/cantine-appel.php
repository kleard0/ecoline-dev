<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecoline</title>
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
        @import url(style-cantine-appel.css);
        @import url(../sidebar.css);
        @import url(../icons.css);
        @import url(cantine-appel.css);
        @import url(sql_login.php);
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    </style>
</head>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //utilise le data inséré dans le champ
    $parent_id = $_POST["parent_ID"];

    //php login
    $host = "localhost";
    $user = "root";
    $password = "";
    $bdd = "ecoline_reservation";

    $connect = new mysqli($host, $user, $password, $bdd);
    if (!$connect) {
        die("Échec de la connexion : " . mysqli_connect_error());
    }

    //data de BDD

    $req_parents = "SELECT * FROM parent where parent_id = '" . $parent_id . "' ";
    $result_parents = $connect->query($req_parents);

    $req_enfants = "SELECT * FROM student INNER JOIN p_s ON p_s.s_id = student.student_id WHERE p_s.p_id = '" . $parent_id . "' ";
    $result_enfants = $connect->query($req_enfants);

    $data_parents = array();
    while ($row_parents = $result_parents->fetch_assoc()) {
        $data_parents[] = $row_parents;
    }

    $data_enfants = array();
    while ($row_enfants = $result_enfants->fetch_assoc()) {
        $data_enfants[] = $row_enfants;
    }
}
?>
<body>
    <div class="container-all">
    <?php include '../components/sidebar.php'; ?>

        <div class="main">
            <div class="head">
                <div class="logo-block">
                    <img src="/image/logo-ecoline.png">
                </div>
                <div class="name-box">
                </div>
            </div>

            <div class="main-container">

            <div class="page-title">
                
                <h1>Gestion Appel</h1>
            </div>
            <div class="appel-menu">
                <div class="container">
                    <div class="student-image">
                    <img src="/image/logo-ecoline.png">
                    </div>
                    <div class="student-name">
                        <p>firstname lastname</p>
                    </div>
                </div>    
                <div class="container">
                    <p>object 2</p>
                </div>
                <div class="container">
                    <p>object 2</p>
                </div>
                <div class="container">
                    <p>object 2</p>
                </div>
                <div class="container">
                    <p>object 2</p>
                </div>
                <div class="container">
                    <p>object 2</p>
                </div>
                <div class="container">
                    <p>object 2</p>
                </div>
                <div class="container">
                    <div class="student-image">
                        <img src="/image/logo-ecoline.png">
                        </div>
                    <p>object 2</p>
                </div>
            </div>
 



            </div>                
        </div>

    </div>

</body>
</html>


