<title>Ecoline</title>
<?php
//ce page est pour l'actualisation de les changements d'options
//dans la page cantine-appel
ob_start();
 require_once 'cantine-appel.php';

 if(isset($_GET['student_id'])){
    $student_id=$_GET['student_id'];
    $presence=$_GET['presence'];

    $update_presence="UPDATE reservation SET presence=$presence 
    WHERE fk_student_id=$student_id AND res_date = CURDATE()";

    mysqli_query($connect,$update_presence);}



    header('location:cantine-appel.php');
    ob_end_flush();
?>