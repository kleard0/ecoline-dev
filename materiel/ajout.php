<?php
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "ecoline";

$connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);
if (!$connexion) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

// Ajout de matériel
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
    $transaction_type = $_POST['transaction_type'];

    // On insère le fournisseur en premier
    if ($query = $connexion->prepare("INSERT INTO Fournisseurs (supplier_id, supplier_name) VALUES (?, ?)")) {
        $query->bind_param("is", $supplier_id, $supplier_name);
        $query->execute();
        $query->close();
    } else {
        die("Erreur de préparation de la requête : " . $connexion->error);
    }

    // On insère la catégorie
    if ($query = $connexion->prepare("INSERT INTO Categories (category_id, category_description) VALUES (?, ?)")) {
        $query->bind_param("is", $category_id, $category_description);
        $query->execute();
        $query->close();
    } else {
        die("Erreur de préparation de la requête : " . $connexion->error);
    }

    // On insère le produit
    if ($query = $connexion->prepare("INSERT INTO Produits (product_id, supplier_id, product_price, category_id, transaction_type) VALUES (?, ?, ?, ?, ?)")) {
        $query->bind_param("iisii", $product_id, $supplier_id, $product_price, $category_id, $transaction_type);
        $query->execute();
        $query->close();
    } else {
        die("Erreur de préparation de la requête : " . $connexion->error);
    }

    // On insère le stock
    if ($query = $connexion->prepare("INSERT INTO Stocks (product_id, stock_quantity, date_ajout, stock_id) VALUES (?, ?, ?, ?)")) {
        $query->bind_param("iisi", $product_id, $stock_quantity, $date_ajout, $stock_id);
        $query->execute();
        $query->close();
    } else {
        die("Erreur de préparation de la requête : " . $connexion->error);
    }

    // On insère l'expéditeur
    if ($query = $connexion->prepare("INSERT INTO Expediteurs (expeditor_id, expeditor_name, fournisseur_id) VALUES (?, ?, ?)")) {
        $query->bind_param("isi", $expeditor_id, $expeditor_name, $supplier_id);
        $query->execute();
        $query->close();
    } else {
        die("Erreur de préparation de la requête : " . $connexion->error);
    }

    header('Location: ajout_materiel.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un matériel</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style type="text/css">
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            margin-top: 20px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        h3 {
            text-align: center;
        }

        form div {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
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
    <div class="container">
        <h3>Ajouter un matériel</h3>
        <form method="POST">
            <div>
                <label>ID</label>
                <input required="required" type="number" id="product_id" name="product_id" />
            </div>
            <div>
                <label>Nom matériel</label>
                <input required="required" type="text" name="category_description" />
            </div>
            <div>
                <label>Stock</label>
                <input required="required" type="number" name="stock_quantity" />
            </div>
            <div>
                <label>Date</label>
                <input required="required" id="date" type="date" name="date_ajout" />
            </div>
            <div>
                <label>Fournisseur</label>
                <input required="required" type="text" name="supplier_name" />
            </div>
            <div>
                <label>Expéditeur</label>
                <input required="required" type="text" name="expeditor_name" />
            </div>
            <div>
                <label>Prix</label>
                <input required="required" type="number" name="product_price" />
            </div>
            <div>
                <label>Type de transaction</label>
                <select required="required" name="transaction_type">
                    <option value="1">Achat</option>
                    <option value="2">Emprunt</option>
                </select>
            </div>
            <div>
                <input type="submit" value="Ajouter" id="ajout" name="ajout" />
            </div>
        </form>
    </div>

    <script>
        document.getElementById('date').valueAsDate = new Date();
    </script>
</body>
</html>
