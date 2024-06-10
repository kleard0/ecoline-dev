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

if (isset($_POST['update'])) {
    $product_id = intval($_POST['product_id']);
    $product_price = intval($_POST['product_price']);
    $category_description = $_POST['category_description'];
    $stock_quantity = intval($_POST['stock_quantity']);
    $date_ajout = $_POST['date_ajout'];
    $supplier_name = $_POST['supplier_name'];
    $expeditor_name = $_POST['expeditor_name'];
    $transaction_type = intval($_POST['transaction_type']);

    if ($query = $connexion->prepare("UPDATE Produits SET product_price = ?, transaction_type = ? WHERE product_id = ?")) {
        $query->bind_param("iii", $product_price, $transaction_type, $product_id);
        $query->execute();
        $query->close();
    } else {
        die("Erreur de préparation de la requête (Produits) : " . $connexion->error);
    }

    if ($query = $connexion->prepare("UPDATE Categories SET category_description = ? WHERE category_id = (SELECT category_id FROM Produits WHERE product_id = ?)")) {
        $query->bind_param("si", $category_description, $product_id);
        $query->execute();
        $query->close();
    } else {
        die("Erreur de préparation de la requête (Categories) : " . $connexion->error);
    }

    if ($query = $connexion->prepare("UPDATE Stocks SET stock_quantity = ?, date_ajout = ? WHERE product_id = ?")) {
        $query->bind_param("isi", $stock_quantity, $date_ajout, $product_id);
        $query->execute();
        $query->close();
    } else {
        die("Erreur de préparation de la requête (Stocks) : " . $connexion->error);
    }

    if ($query = $connexion->prepare("UPDATE Fournisseurs SET supplier_name = ? WHERE supplier_id = (SELECT supplier_id FROM Produits WHERE product_id = ?)")) {
        $query->bind_param("si", $supplier_name, $product_id);
        $query->execute();
        $query->close();
    } else {
        die("Erreur de préparation de la requête (Fournisseurs) : " . $connexion->error);
    }

    // Assurez-vous de lier l'expéditeur au bon fournisseur
    if ($query = $connexion->prepare("UPDATE Expediteurs SET expeditor_name = ? WHERE expeditor_id = (SELECT expeditor_id FROM Produits WHERE product_id = ?) AND fournisseur_id = (SELECT supplier_id FROM Produits WHERE product_id = ?)")) {
        $query->bind_param("sii", $expeditor_name, $product_id, $product_id);
        $query->execute();
        $query->close();
    } else {
        die("Erreur de préparation de la requête (Expediteurs) : " . $connexion->error);
    }

    header('Location: ' . $_SERVER['REQUEST_URI']);
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
    e.expeditor_name,
    CASE
        WHEN p.transaction_type = 1 THEN 'Prêt'
        WHEN p.transaction_type = 2 THEN 'Emprunt'
        ELSE 'N/A'
    END AS transaction_type
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

?>  

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des matériels</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style type="text/css">
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .container-all {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding-top: 20px;
        }

        .container-materiel {
            width: 80%;
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
            margin-bottom: 20px;
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

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        input[type="text"], input[type="number"], input[type="date"], select, input[type="submit"] {
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
</head>
<body>
    <div class="container-all container-materiel">
        <div class="container">
            <h3>Liste des matériels</h3>
            <table class="mystock_table">
                <tr>
                    <th>ID</th>
                    <th>Nom matériel</th>
                    <th>Stock</th>
                    <th>Prix</th>
                    <th>Prêt/Achat</th>
                    <th>Date</th>
                    <th>Fournisseur</th>
                    <th>Expéditeur</th>
                    <th>Action</th>
                </tr>
                <?php
                foreach ($donnees_produits as $ligne_produits) {
                    echo "<tr>";
                    echo "<td>" . $ligne_produits['product_id'] . "</td>";
                    echo "<td>" . $ligne_produits['category_description'] . "</td>";
                    echo "<td>" . $ligne_produits['stock_quantity'] . "</td>";
                    echo "<td>" . $ligne_produits['product_price'] . "€</td>";
                    echo "<td>" . $ligne_produits['transaction_type'] . "</td>";
                    echo "<td>" . $ligne_produits['date_ajout'] . "</td>";
                    echo "<td>" . $ligne_produits['supplier_name'] . "</td>";
                    echo "<td>" . $ligne_produits['expeditor_name'] . "</td>";
                    echo "<td>
                        <button onclick='editProduct(" . json_encode($ligne_produits) . ")'>Modifier</button>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>

    <div id="editForm" style="display:none;" class="container">
        <h3>Modifier un matériel</h3>
        <form method="POST">
            <input type="hidden" name="product_id" id="edit_product_id">
            <div>
                <label>Nom matériel</label>
                <input required="required" type="text" name="category_description" id="edit_category_description">
            </div>
            <div>
                <label>Stock</label>
                <input required="required" type="number" name="stock_quantity" id="edit_stock_quantity">
            </div>
            <div>
                <label>Date</label>
                <input required="required" type="date" name="date_ajout" id="edit_date_ajout">
            </div>
            <div>
                <label>Fournisseur</label>
                <input required="required" type="text" name="supplier_name" id="edit_supplier_name">
            </div>
            <div>
                <label>Expéditeur</label>
                <input required="required" type="text" name="expeditor_name" id="edit_expeditor_name">
            </div>
            <div>
                <label>Prix</label>
                <input required="required" type="number" name="product_price" id="edit_product_price">
            </div>
            <div>
                <label>Type de transaction</label>
                <select required="required" name="transaction_type" id="edit_transaction_type">
                    <option value="1">Prêt</option>
                    <option value="2">Achat</option>
                </select>
            </div>
            <div>
                <input type="submit" value="Modifier" name="update">
            </div>
        </form>
    </div>

    <script>
    function editProduct(product) {
        document.getElementById('edit_product_id').value = product.product_id;
        document.getElementById('edit_category_description').value = product.category_description;
        document.getElementById('edit_stock_quantity').value = product.stock_quantity;
        document.getElementById('edit_date_ajout').value = product.date_ajout;
        document.getElementById('edit_supplier_name').value = product.supplier_name;
        document.getElementById('edit_expeditor_name').value = product.expeditor_name;
        document.getElementById('edit_product_price').value = product.product_price;
        document.getElementById('edit_transaction_type').value = product.transaction_type === 'Prêt' ? 1 : 2;
        document.getElementById('editForm').style.display = 'block';
    }
    </script>
</body>
</html>
