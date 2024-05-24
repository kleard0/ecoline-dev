@ -0,0 +1,40 @@
<?php
//
//
//
// CETTE PAGE SERA POUR LE PARENT A FAIRE L'APPEL
//
//
//
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "ecoline_reservation";

// Connexion à la bdd avec mysqli
$connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);
if (!$connexion) {
    die("Échec de la connexion : " . mysqli_connect_error());
}


// Ici je récupère les données de mon formulaire et je les stock dans des variables php
$parent_id = mysqli_real_escape_string($connexion, $_POST['parent_ID']); // donée
//$book_isbn = mysqli_real_escape_string($connexion, $_POST['book_isbn']);

// Pour l'historique

//$date = date('d-m-y h:i:s');
//$addID = "add" . "$book_title" ."$date";
//$reservationdata = "$reservation_id" . "$reservation_date" ."$presence"; 
//$type = "connect";
//$parent_list = "SELECT FROM history(ID, Date, Type, BookData) VALUES ('$addID', '$date', '$type', '$bookdata')";
$connexion->query($parent_list);

// Je crée et envoie ma requette avec les info contenu dans mes variables d'avant
//$requete = "INSERT INTO books (barcode, title, is_book, genre, isbn, is_borrowed, author) VALUES ('$book_id', '$book_title', 1, 'test', '$book_isbn', 0, '$book_author')";

// seléctionner tous les IDs d'élèves liées à l'ID de parent mis
$requete = "SELECT * from student WHERE parent_student.parent_parent_id = $parent_id";

//$requete = "SELECT * FROM `student` INNER JOIN parent_student ON parent_student.student_student_id = student.student_id WHERE parent_student.parent_parent_id = 2;";
$resultat = $connexion->query($requete);

if (!$resultat) {
    die("Erreur lors de l'exécution de la requête : " . $connexion->error);
}

// Je redirige vers ma page menu
header("Location: reserve1.php");
exit();

// EXEMPLE LIASISON
// SELECT * FROM `student` INNER JOIN parent_student ON parent_student.student_student_id = student.student_id
//WHERE parent_student.parent_parent_id = 2;
?>
