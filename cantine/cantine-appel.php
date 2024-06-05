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
    ob_start();
include 'sql_login.php';
while ($row_appel = $result_appel->fetch_assoc()) {
    $data_appel[] = $row_appel;} ?>
<body>
    <div class="container-all">
        
        <?php

        include '../components/sidebar.php'; 
        ?>
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
                    <?php
                    echo "<h1>Gestion Appel " . $currentDate . "</h1>";?>
                </div>
                <table class="table_appel">
                <tr>
                    <th scope='col'>ID</th>
                    <th scope='col'>Name</th>
                    <th scope='col'>Option</th>
                    
                </tr>
                <?php
                foreach ($data_appel as $row_appel) {
                    echo "<tr>";
                    echo '<td>' . $row_appel["student_id"] . '</td>';
                    echo '<td>'. $row_appel["first_name"] . " " . $row_appel["last_name"] .' </td>';
                    if( $row_appel["presence"]==1){
                        echo '<td><p><a href="active-appel.php?student_id='.$row_appel["student_id"].'&presence=0">présent</a></p></td>';
                        }
                    else{
                        echo '<td><p><a href="active-appel.php?student_id='.$row_appel["student_id"].'&presence=1">Absent</a></p></td>';
                        }
                   /* echo "<td>
                                    <form action=" . "/cantine/reserve3.php " . "method=" . "POST" . ">
                                    <input type=" . "checkbox" . "name=" . "checkbox" . " value=" . $row_appel["student_id"] . ">
                                    <button type=" . "submit" . ">" . "Choisir" . "</button></form>
                                    </td>";
                    /*
                    echo "<td><button method="."POST"." onclick=\"location.href='/cantine/reserve3.php?student_id=".$row_enfants["student_id"]."'\">Choisir</button></td>"; */
                    echo "</tr>";
                }
                ob_end_flush();
                ?>
            </table><br>
            <table class="table_appel">
                <tr>
                
                    <th scope='col'>
                      <form action="" method="GET">
                       <input type="text" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" placeholder="Ajouter un élève">
                       <button type="submit" class="btn btn-primary">Search</button>
                    </th>
                </tr>
            </table>

                <?php 
                                 if(isset($_GET['search']))
                                 {
                                    echo  '<table class="table_appel">';
                                    echo  "<th scope='col'>Name</th>";
                                    echo  "<th scope='col'>Option</th>";
                        
                                     $filtervalues = $_GET['search'];
                                     $query = "SELECT DISTINCT * FROM reservation FULL JOIN student 
                                     ON fk_student_id = student.student_id WHERE CONCAT(first_name,last_name) LIKE '%$filtervalues%' AND res_date=CURDATE() 
                                     GROUP BY first_name, last_name";
                                     $query_run = mysqli_query($connect, $query);


                                     if(mysqli_num_rows($query_run) > 0)
                                     {
                                         foreach($query_run as $element)
                                         {
                                            $register = "INSERT INTO reservation(res_date,fk_student_id) VALUES (CURDATE(),'" . $element["student_id"] . "')";
                                            
                                            echo "<tr>";
                                            echo '<td>'.$element['first_name'].' '.$element['last_name'].'</td>';
                                            if((!empty($element["presence"]))){
                                                echo '<td>Cet élève est déja enrigestré</td>';
                                                }
                                            else{
                                                echo '<td>
                                                <form action="" method="POST">
                                                <input type="hidden" name="ajouter" value="' . $element["student_id"] . '">
                                                <button type="submit">Choisir</button></form>
                                                </td>';
                                            }
                                            echo "</tr>";
                                         }
                                     }
                                     else
                                     {
                                        echo "<tr>";
                                        echo '<td>No Record Found</td>';
                                        echo "</tr>";
                                    }
                                    if (isset($_POST["reserve_date"])) {
                                }
                            }
                                         ?>
                          </table>
                                         

            </div>
        </div>
    </div>

    </div>

</body>

</html>
<style>
    .table_appel {
    width: 80%;
    margin-left: auto;
    margin-right: auto;
    border-collapse: collapse;
    border: 2px solid rgb(140 140 140);
    font-family: sans-serif;
    font-size: 0.8rem;
    letter-spacing: 1px;
  }
  
  th,td {
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
  <script>

