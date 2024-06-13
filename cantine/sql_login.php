<?php

//php login
$host = "localhost";
$user = "root";
$password = "";
$bdd = "ecoline_reservation";

// Connexion à la bdd avec mysqli  
$connect = new mysqli($host, $user, $password, $bdd);
if (!$connect) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

//data de BDD

/*
 $data_parents = array();
 while ($row_parents = $result_parents->fetch_assoc()) {
     $data_parents[] = $row_parents;
 }

 */
if (isset($_POST["parent_id"])) {
    //utilise le data inséré dans le champ
    $_SESSION["parent_id"] = $_POST["parent_id"];
    $req_parents = "SELECT * FROM parent where parent_id = '" . $_SESSION["parent_id"] . "' ";
    $result_parents = $connect->query($req_parents);
    $row_parents = mysqli_fetch_array($result_parents);
    $req_enfants = "SELECT * FROM student INNER JOIN p_s ON p_s.s_id = student.student_id WHERE p_s.p_id = '" . $_SESSION["parent_id"] . "' ";
    $result_enfants = $connect->query($req_enfants);
}




/*
$data_enfants = array();
while ($row_enfants = $result_enfants->fetch_assoc()) {
    $data_enfants[] = $row_enfants;
}
*/
if (isset($_POST["student_id"])) {

    $_SESSION["student_id"] = $_POST["student_id"];
    $req_enfants = "SELECT * FROM student WHERE student_id = '" . $_SESSION["student_id"] . "' ";
    $result_enfants = $connect->query($req_enfants);

    $row_enfants = mysqli_fetch_array($result_enfants);
}

$req_histoire = "SELECT * FROM reservation 
FULL JOIN student 
ON fk_student_id = student.student_id ORDER BY res_date DESC ";
$result_histoire = $connect->query($req_histoire);


$currentDate = date('Y-m-d');
$req_appel = "SELECT * FROM reservation 
FULL JOIN student 
ON fk_student_id = student.student_id WHERE res_date = CURDATE()";
$result_appel= $connect->query($req_appel);


// EXEMPLE LIASISON
// SELECT * FROM `student` INNER JOIN parent_student ON parent_student.student_student_id = student.student_id
//WHERE parent_student.parent_parent_id = 2;
?>