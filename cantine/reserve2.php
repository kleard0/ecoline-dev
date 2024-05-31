<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reserve2</title>
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
        @import url(../../components/sidebar.php);
        @import url(../../components/sidebar.css);
        @import url(../../sidebar.css);
        @import url(../../style.css);
        @import url(../../icons.css);
        @import url(style.css);
        @import url(reserve.php);
        @import url(reserve2.css);
        @import url(sql_login.php);
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    </style>
</head>

<?php

    include 'sql_login.php';

    $req_enfants = "SELECT * FROM student";
    $result_enfants = $connect->query($req_enfants);
    $data_enfants = array();
    while ($row_enfants = $result_enfants->fetch_assoc()) {
        $data_enfants[] = $row_enfants;
    }
?>

<!--this can be put in a function file -->

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
            <div class="parent_name">
                <?php

                $result_parents = $connect->query($req_parents);
                $row_parents = mysqli_fetch_array($result_parents);
                if ($result_parents->num_rows > 0) {
                    // output data of each row
                    // row 0: ID --- row 1: first name --- row2: last name 
                    echo nl2br("$row_parents[0] : le parent est '$row_parents[1] $row_parents[2]'
              \n");
                }

                ?>

            </div>
            <table class="table_enfants">
                <tr>
                    <!-- <th scope='col'>ID</th> -->
                    <th scope='col'>Name</th>
                    <th scope='col'>Option</th>
                    <!--
                                <th scope='col'>city</th>
                                <th scope='col'>mobile</th>
                                <th scope='col'>phone</th>
                                <th scope='col'>email</th> --->
                </tr>
                <?php

                foreach ($data_enfants as $row_enfants) {
                    echo "<tr>";
                    //   echo "<td>" . $row_enfants["student_id"] . "</td>";
                    echo "<td>" . $row_enfants["first_name"] . " " . $row_enfants["last_name"] . "</td>";

                    echo "<td>
                                    <form action=" . "/cantine/reserve3.php " . "method=" . "POST" . ">
                                    <input type=" . "hidden " . "name=" . "student_id" . " value=" . $row_enfants["student_id"] . ">
                                    <button type=" . "submit" . ">" . "Choisir" . "</button></form>
                                    </td>";
                    /*
                    echo "<td><button method="."POST"." onclick=\"location.href='/cantine/reserve3.php?student_id=".$row_enfants["student_id"]."'\">Choisir</button></td>"; */
                    echo "</tr>";
                }
                ?>
            </table>
        </div> <!--- end of main --->
    </div>

    </div>
</body>

</html>