<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reserve3</title>
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
        @import url(../../components/sidebar.php);
        @import url(../../components/sidebar.css);
        @import url(../../sidebar.css);
        @import url(../../style.css);
        @import url(../../icons.css);
        @import url(style.css);
        @import url(reserve2.php);
        @import url(reserve.css);
        @import url(sql_login.php);
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    </style>
</head>
<?php
include 'sql_login.php';
if (isset($_POST["user_id"])) {

    $_SESSION["user_id"] = $_POST["user_id"];
    $req_enfants = "SELECT * FROM users where account_type = 'student' AND user_id = '" . $_SESSION["user_id"] . "' ";
    $result_enfants = $connect->query($req_enfants);

    $row_enfants = mysqli_fetch_array($result_enfants);
}
?>


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
            <br>
            <?php if (isset($_SESSION['status'])) {
                echo "<h4>" . $_SESSION['status'] . "</h4>";
                unset($_SESSION['status']);
            }

            if (isset($_POST["user_id"])) {
                echo "student : [" . $_POST["user_id"] . "] " . $row_enfants[1] . " " . $row_enfants[2];
            }


            ?>
            <form action="" method="post">
                <label for="">Date de réservation :</label>
                <input name="reserve_date" id="reserve_date" type="date" required />
                <button type="submit">confirm</button>

                <div class="button_section">
                    <div class="button">
                        <a href="/cantine/reserve.php">
                            <p>Annuler</p>
                        </a>
                    </div>
                    <?php

                    if (isset($_POST["reserve_date"])) {
                        $reserve_date = date('y-m-d', strtotime($_POST["reserve_date"]));

                        $query = "INSERT INTO reservation(res_date,fk_student_id) VALUES ('$reserve_date',(SELECT user_id FROM users WHERE user_id =  '" . $_SESSION["user_id"] . "'))";
                        $query_run = $connect->query($query);
                    }
                    ?>
            </form>
        </div> <!--- end of main --->

    </div>

    </div>
</body>

</html>