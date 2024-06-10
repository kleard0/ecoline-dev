<?php
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "ecoline";

$connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);
if (!$connexion) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

if (!isset($_SESSION['ID'])) {
    header("Location: login.php");
    exit;
}

$roles = $_SESSION['roles'];
if ($roles !==3 && $roles !== 4) {
    header('Location : login.php');
    exit;
}

$requete_produits = "
SELECT 
    p.product_id,
    p.product_price,
    cat.category_description,
    s.stock_quantity,
    s.date_ajout,
    f.supplier_name,
    e.expeditor_name
FROM produits as p
LEFT JOIN categories as cat ON 
    cat.category_id = p.category_id
LEFT JOIN stocks as s ON
    s.product_id = p.product_id
LEFT JOIN fournisseurs as f ON
    f.supplier_id = p.supplier_id
LEFT JOIN expediteurs as e ON
    e.fournisseur_id = f.supplier_id";

$resultat_produits = $connexion->query($requete_produits);

$donnees_produits = array();
while ($ligne_produits = $resultat_produits->fetch_assoc()) {
    $donnees_produits[] = $ligne_produits;
}

// if (isset($_POST['delete'])) {
//     $did = intval($_POST['id']);
//     // Première requête pour supprimer les clés étrangères
//     if ($query = $connexion->prepare("DELETE FROM stocks WHERE product_id = ?")) {
//         $query->bind_param("i", $did);
//         $query->execute();
//         $query->close();
//     } else {
//         die("Erreur de préparation de la requête : " . $connexion->error);
//     }
//     // Seconde requête pour supprimer le produit
//     if ($query = $connexion->prepare("DELETE FROM produits WHERE product_id = ?")) {
//         $query->bind_param("i", $did);
//         $query->execute();
//         $query->close();
//     } else {
//         die("Erreur de préparation de la requête : " . $connexion->error);
//     }

//     header('Location: ' . $_SERVER['REQUEST_URI']);
//     exit;
// }


if (isset($_POST['ajout'])) {
    $product_id = intval($_POST['product_id']);
    $product_price = intval($_POST['product_price']);
    $supplier_name = $_POST['supplier_name'];
    $supplier_id = mt_rand(0, 10000);
    $expeditor_id = mt_rand(0, 10000);
    $expeditor_name = $_POST['expeditor_name'];
    $stock_id = mt_rand(0, 10000);
    $stock_quantity = $_POST['stock_quantity'];
    $category_id = mt_rand(0, 10000);
    $category_description = $_POST['category_description'];
    $date_ajout = $_POST['date_ajout'];
    //On insère le fournisseur en premier
    if ($query = $connexion->prepare("INSERT INTO Fournisseurs (supplier_id, supplier_name) VALUES (?, ?)")) {
        $query->bind_param("is", $supplier_id, $supplier_name);
        $query->execute();
        $query->close();
    } else {
        die("Erreur de préparation de la requête : " . $connexion->error);
    }
    //On insère la catégorie
    if ($query = $connexion->prepare("INSERT INTO Categories (category_id, category_description) VALUES (?, ?)")) {
        $query->bind_param("is", $category_id, $category_description);
        $query->execute();
        $query->close();
    } else {
        die("Erreur de préparation de la requête : " . $connexion->error);
    }
    //On insère le prix
    if ($query = $connexion->prepare("INSERT INTO Produits (product_id, supplier_id, product_price, category_id) VALUES (?, ?, ?, ?)")) {
    $query->bind_param("iisi", $product_id, $supplier_id, $product_price, $category_id);
    $query->execute();
    $query->close();
    } else {
        die("Erreur de préparation de la requête : " . $connexion->error);
    }
   
    //On insère le stock
    if ($query = $connexion->prepare("INSERT INTO Stocks (product_id, stock_quantity, date_ajout, stock_id) VALUES (?, ?, ?, ?)")) {
        $query->bind_param("iisi", $product_id, $stock_quantity, $date_ajout, $stock_id);
        $query->execute();
        $query->close();
    } else {
        die("Erreur de préparation de la requête : " . $connexion->error);
    }
//On insère l''expéditeur
if ($query = $connexion->prepare("INSERT INTO Expediteurs (expeditor_id, expeditor_name, fournisseur_id) VALUES (?, ?, ?)")) {
    $query->bind_param("isi", $expeditor_id, $expeditor_name, $supplier_id);
    $query->execute();
    $query->close();
} else {
    die("Erreur de préparation de la requête : " . $connexion->error);
}
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit;
}

$script = <<< JS
    document.getElementById('date').valueAsDate = new Date();
JS;
?>  

<link rel="icon" href="favicon.ico" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<style type="text/css">
    @import url('../components/sidebar.css');
    @import url('../style.css');
    @import url('../manage.css');
</style>


<div class="container-all container-materiel">
    <div style="width: 350%;">
        <?php include '../components/sidebar.php'; ?>
    </div>
    <div>
        <table class="mystock_table">
            <tr>
                <th>ID </th>
                <th>Nom mat&eacute;riel</th>
                <th>Stock</th>
                <th>Prix</th>
                <th>Achat/Emprunt</th>
                <th>Date</th>
                <th>Fournisseur</th>
                <th>Exp&eacute;diteur</th>
            </tr>
            <?php
            foreach ($donnees_produits as $ligne_produits) {
                echo "<tr>";
                echo "<td>" . $ligne_produits['product_id'] . "</td>";
                echo "<td>" . $ligne_produits['category_description'] . "</td>";
                echo "<td>" . $ligne_produits['stock_quantity'] . "</td>";
                echo "<td>" . $ligne_produits['product_price'],"€" . "</td>";
                echo "<td>" . "" . "</td>";
                echo "<td>" . $ligne_produits['date_ajout'] . "</td>";
                echo "<td>" . $ligne_produits['supplier_name'] . "</td>";
                echo "<td>" . $ligne_produits['expeditor_name'] . "</td>";
                echo "<td><form method='POST'>
                <input type=hidden name=id value=" . $ligne_produits['product_id'] . " >
                </form>
                </td>";
                echo "</tr>";
            }
        echo "<br />";
        ?>
        </table>
    </div>
</div>

<style>

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
    color: #333;
}

.container-materiel {
    display: grid;
    grid-template-columns: 1fr 3fr;
}

.container {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    padding: 20px;
    margin-top: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 8px;
    text-align: left;
    border: 1px solid #ddd;
}

th {
    background-color: #4CAF50;
    color: white;
}

tr:nth-child(even) {background-color: #f2f2f2;}

input[type="text"], input[type="number"], input[type="date"], input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}
</style>