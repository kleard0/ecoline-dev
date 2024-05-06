<?php
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "ecoline";

$connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);
if (!$connexion) {
    die("Échec de la connexion : " . mysqli_connect_error());
}


$requete_produits = "SELECT * FROM produits";
$resultat_produits = $connexion->query($requete_produits);
$requete_history = "SELECT * FROM history";
$resultat_history = $connexion->query($requete_history);


$donnees_produits = array();
while ($ligne_produits = $resultat_produits->fetch_assoc()) {
    $donnees_produits[] = $ligne_produits;
}
$donnees_history = array();
while ($ligne_history = $resultat_history->fetch_assoc()) {
    $donnees_history[] = $ligne_history;
}


?>

<table class="mystock_table">
    <tr>
        <th>ID </th>
        <th>Nom matériel</th>
        <th>Stock</th>
        <th>Achat/Emprun</th>
        <th>ID Elève</th>
        <th>Date</th>
        <th>Fournisseur</th>
        <th>Expéditeur</th>
    </tr>
<?php
    foreach ($donnees_produits as $ligne_produits) {
        echo "<tr>";
        foreach ($ligne_produits as $valeur_produits) {
            echo "<td>" . $valeur_produits . "</td>";
        }
        echo "</tr>";
    }
?>
</table>