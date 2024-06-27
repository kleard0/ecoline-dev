<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecoline</title>
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
        @import url(reserve.css);
        @import url(../sidebar.css);
        @import url(../../sidebar.css);
        @import url(../../style.css);
        @import url(../../icons.css);
        @import url(style-cantine.css);
        @import url(../icons.css);
        @import url(sql_login.php);
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    </style>
</head>
<?php
include 'sql_login.php';
?>

<body>
    <div class="container-all">
        <?php include '../components/sidebar.php'; ?>

        <div class="main">
            <div class="head">
                <div class="logo-block">
                    <img src="/image/logo-ecoline.png">
                </div>
            </div>
            <div class="page-title">
                <h1>Historique de la cantine</h1>
            </div>


            <div class="main-container">

                <table class="table_historique">
                    <tr>
                        <th scope='col'>Name</th>
                        <th scope='col'>ID</th>
                        <th scope='col'>Date</th>
                        <th scope='col'>Présence</th>
                    </tr>
                    <?php

                    foreach ($data_historique as $row_historique) {
                        if (!empty($row_historique["reservation_id"])) {
                            echo "<tr>";
                            echo "<td>" . $row_historique["first_name"] . " " . $row_historique["last_name"] . "</td>";
                            echo "<td>" . $row_historique["user_id"] . "</td>";
                            echo "<td>" . $row_historique["res_date"] . " </td>";
                            if ($row_historique["presence"] == 1) {
                                echo "<td>Présent</td>";
                            } else {
                                echo "<td>Absent</td>";
                            }
                        echo "</tr>";
                        }
                    }
                    ?>
                </table>

            </div>
        </div>

    </div>

</body>

</html>

<style>
    .table_histoire {
        width: 80%;
        margin-left: auto;
        margin-right: auto;
        border-collapse: collapse;
        border: 2px solid rgb(140 140 140);
        font-family: sans-serif;
        font-size: 0.8rem;
        letter-spacing: 1px;
    }

    th,
    td {
        border: 1px solid rgb(160 160 160);
        padding: 8px 10px;
    }

    th[scope='col'] {
        background-color: #505050;
        color: #fff;
    }

    th[scope='row'] {
        background-color: #d4e4ec;
    }

    td {
        text-align: center;
    }

    tr:nth-of-type(even) {
        background-color: #eee;
    }
</style>