<?php
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "ecoline";

$connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);
if (!$connexion) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

// Requête pour récupérer l'historique des réservations
$requete_reservations = "
SELECT 
    r.reservation_id,
    r.client_name,
    r.start_date,
    r.end_date,
    r.date_reserved,
    p.product_id,
    p.product_price,
    cat.category_description,
    f.supplier_name,
    e.expeditor_name
FROM Reservations as r
LEFT JOIN Produits as p ON r.product_id = p.product_id
LEFT JOIN Categories as cat ON cat.category_id = p.category_id
LEFT JOIN Fournisseurs as f ON f.supplier_id = p.supplier_id
LEFT JOIN Expediteurs as e ON e.fournisseur_id = f.supplier_id";

$resultat_reservations = $connexion->query($requete_reservations);

$donnees_reservations = array();
while ($ligne_reservations = $resultat_reservations->fetch_assoc()) {
    $donnees_reservations[] = $ligne_reservations;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des réservations</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h3>Historique des réservations</h3>
        <table>
            <tr>
                <th>ID Réservation</th>
                <th>Client</th>
                <th>Nom matériel</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Date de réservation</th>
                <th>Prix</th>
                <th>Fournisseur</th>
                <th>Expéditeur</th>
            </tr>
            <?php foreach ($donnees_reservations as $ligne_reservations): ?>
            <tr>
                <td><?= $ligne_reservations['reservation_id'] ?></td>
                <td><?= $ligne_reservations['client_name'] ?></td>
                <td><?= $ligne_reservations['category_description'] ?></td>
                <td><?= $ligne_reservations['start_date'] ?></td>
                <td><?= $ligne_reservations['end_date'] ?></td>
                <td><?= $ligne_reservations['date_reserved'] ?></td>
                <td><?= $ligne_reservations['product_price'] ?>€</td>
                <td><?= $ligne_reservations['supplier_name'] ?></td>
                <td><?= $ligne_reservations['expeditor_name'] ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
