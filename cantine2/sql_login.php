<?php

//php login
$host = "localhost";
$user = "root";
$password = "";
$bdd = "ecoline";

// Connexion à la bdd avec mysqli  
$connect = new mysqli($host, $user, $password, $bdd);
if (!$connect) {
    die("Échec de la connexion : " . mysqli_connect_error());
}




if (isset($_POST["user_id"])) {
    //utilise le data inséré dans le champ
    $_SESSION["user_id"] = $_POST["user_id"];
    $req_parents = "SELECT * FROM users where account_type = 'parent' AND user_id = '" . $_SESSION["user_id"] . "' ";
    $result_parents = $connect->query($req_parents);
    $row_parents = mysqli_fetch_array($result_parents);
    $req_enfants = "SELECT DISTINCT T1.* FROM users T1 
    join users T2 ON T1.family_id = T2.family_id 
    WHERE  T1.user_id != T2.user_id 
    AND T1.account_type='student'  
    AND t1.user_id != '" . $_SESSION["user_id"] . "' ";
    $result_enfants = $connect->query($req_enfants);
}




$req_historique = "SELECT * FROM reservation 
FULL JOIN users 
ON fk_student_id = users.user_id  ORDER BY res_date DESC";
$result_historique = $connect->query($req_historique);
$data_historique = array();
while ($row_historique = $result_historique->fetch_assoc()) {
    $data_historique[] = $row_historique;
}


$currentDate = date('Y-m-d');
$req_appel = "SELECT * FROM reservation 
FULL JOIN users 
ON fk_student_id = users.user_id WHERE users.account_type = 'student' AND res_date = CURDATE()";
$result_appel= $connect->query($req_appel);
?>