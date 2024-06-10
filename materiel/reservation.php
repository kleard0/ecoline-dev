<?php
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "ecoline";

$connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);
if (!$connexion) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

/*if (!isset($_SESSION['ID'])) {
    header("Location: login.php");
    exit;
}

$roles = $_SESSION['roles'];
if ($roles ===1) {
    header('Location : login.php');
    exit;
}*/

// Requête pour récupérer les produits
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
        WHEN p.transaction_type = 1 THEN 'Achat'
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
if($resultat_produits) {
    while ($ligne_produits = $resultat_produits->fetch_assoc()) {
        $donnees_produits[] = $ligne_produits;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des matériels</title>
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
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }

        h3 {
            text-align: center;
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

        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .form-container {
            display: none;
            margin-top: 20px;
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
        <h3>Liste des matériels</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Nom matériel</th>
                <th>Stock</th>
                <th>Prix</th>
                <th>Achat/Emprunt</th>
                <th>Date</th>
                <th>Fournisseur</th>
                <th>Expéditeur</th>
                <th>Action</th>
            </tr>
            <?php foreach ($donnees_produits as $ligne_produits): ?>
            <tr>
                <td><?= $ligne_produits['product_id'] ?></td>
                <td><?= $ligne_produits['category_description'] ?></td>
                <td><?= $ligne_produits['stock_quantity'] ?></td>
                <td><?= $ligne_produits['product_price'] ?>€</td>
                <td><?= $ligne_produits['transaction_type'] ?></td>
                <td><?= $ligne_produits['date_ajout'] ?></td>
                <td><?= $ligne_produits['supplier_name'] ?></td>
                <td><?= $ligne_produits['expeditor_name'] ?></td>
                <td>
                    <button onclick="openReservationForm(<?= $ligne_produits['product_id'] ?>, '<?= $ligne_produits['category_description'] ?>')">Réserver</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="container form-container" id="reservationForm">
        <h3>Réserver un matériel</h3>
        <form method="POST" action="reservation.php">
            <input type="hidden" name="product_id" id="form_product_id">
            <div>
                <label>Nom matériel</label>
                <input type="text" id="form_category_description" disabled>
            </div>
            <div>
                <label>Nom du client</label>
                <input required="required" type="text" name="client_name">
            </div>
            <div>
                <label>Date de début</label>
                <input required="required" type="date" name="start_date">
            </div>
            <div>
                <label>Date de fin</label>
                <input required="required" type="date" name="end_date">
            </div>
            <div>
                <input type="submit" value="Réserver">
            </div>
        </form>
    </div>

    <script>
    function openReservationForm(productId, categoryDescription) {
        document.getElementById('form_product_id').value = productId;
        document.getElementById('form_category_description').value = categoryDescription;
        document.getElementById('reservationForm').style.display = 'block';
    }
    </script>
</body>
</html>

<?php
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "ecoline";

$connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);
if (!$connexion) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

if (isset($_POST['product_id'], $_POST['client_name'], $_POST['start_date'], $_POST['end_date'])) {
    $product_id = intval($_POST['product_id']);
    $client_name = $_POST['client_name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Vérifier le stock disponible
    $requete_stock = $connexion->prepare("SELECT stock_quantity FROM Stocks WHERE product_id = ?");
    $requete_stock->bind_param("i", $product_id);
    $requete_stock->execute();
    $requete_stock->bind_result($stock_quantity);
    $requete_stock->fetch();
    $requete_stock->close();

    if ($stock_quantity > 0) {
        // Réduire le stock de 1
        $nouveau_stock = $stock_quantity - 1;
        if ($query = $connexion->prepare("UPDATE Stocks SET stock_quantity = ? WHERE product_id = ?")) {
            $query->bind_param("ii", $nouveau_stock, $product_id);
            $query->execute();
            $query->close();
        } else {
            die("Erreur de préparation de la requête (Stocks) : " . $connexion->error);
        }

        // Si le stock est à zéro, supprimer l'enregistrement de la table Stocks
        if ($nouveau_stock == 0) {
            if ($query = $connexion->prepare("DELETE FROM Stocks WHERE product_id = ?")) {
                $query->bind_param("i", $product_id);
                $query->execute();
                $query->close();
            } else {
                die("Erreur de préparation de la requête (Stocks Delete) : " . $connexion->error);
            }
        }

        // Insérer la réservation dans la table `Reservations`
        if ($query = $connexion->prepare("INSERT INTO Reservations (product_id, client_name, start_date, end_date) VALUES (?, ?, ?, ?)")) {
            $query->bind_param("isss", $product_id, $client_name, $start_date, $end_date);
            $query->execute();
            $query->close();
        } else {
            die("Erreur de préparation de la requête (Reservations) : " . $connexion->error);
        }

        header('Location: liste_materiel.php');
        exit;
    } else {
        echo "Stock insuffisant pour ce produit.";
    }
}
?>


