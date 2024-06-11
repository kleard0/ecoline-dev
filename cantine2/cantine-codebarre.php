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
                    <form action="/cantine/cantine-codebarre.php" method="POST">
                        <div class="field">
                            <label for="ID">Lecteur Code-barre:</label>
                            <input name="code_barre" id="code_barre" type="number" placeholder="Code Barre" required
                                autofocus />
                            <!-- required est pour obliger de saisir des valeurs -->
                        </div>

                        <button type="submit">Valider</button>
                    </form>
                </div>
                <br>
                <form action="cantine-appel.php" method="POST">
                    <input type="hidden">
                    <button type="submit">Saisir l'appel manuellement</button>
                    </td>
                    <?php

                    if (isset($_POST["code_barre"])) {
                        $barcode=$_POST["code_barre"];
                        $scan = "SELECT DISTINCT * FROM student 
                        INNER JOIN student_barcode ON student.student_id=student_barcode.fk_student_id 
                        INNER JOIN reservation ON student.student_id=reservation.fk_student_id 
                        WHERE student_barcode.code_id=$barcode 
                        GROUP BY first_name, last_name";
                        mysqli_query($connect, $scan);

                        $verify = "INSERT INTO reservation(res_date,fk_student_id) VALUES (CURDATE(),(SELECT fk_student_id FROM student_barcode WHERE code_id =$barcode))";
                        mysqli_query($connect, $verify);
                        echo "<h4>Élève nrigestré</h4>";
                        /*
                        //check si le tableau n'a pas de data enregistrée déjà avec ce nom
                        if (mysqli_num_rows($check_run) === 0) {
                            $register = "INSERT INTO reservation(res_date,fk_student_id) VALUES (CURDATE(),'" . $_GET["ajouter"] . "')";
                            mysqli_query($connect, $register);
                            header('location:active-appel.php');
                        } else {
                            echo "<td>Cet élève est déja enrigestré</td>";
                        }
                        */
                    } ?>
                </form>
            </div>
        </div>
    </div> <!--- end of main --->

    </div>
</body>

</html>