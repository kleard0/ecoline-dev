<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique</title>
    <link rel="icon" href="favicon.ico" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style type="text/css">
        @import url(../../components/sidebar.php);
        @import url(../../components/sidebar.css);
        @import url(../../style.css);
        @import url(../../icons.css);
        @import url(mystock.css);
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        .highlight {
            background-color: #ffff99;
        }
    </style>
</head>

<body>
    <div class="container-all">
        <?php include '../../components/sidebar.php'; ?>

        <div class="main">
            <div class="head">
                <div class="logo-block">
                    <img src="/image/logo-ecoline.png">
                </div>
            </div>
            <div class="mystock_shortcut">
                <h1>Mes livres</h1>
                <a href="livremanuel.php"><button> Retour</button></a>
                <h2>Données de la Table</h2>
                <input type="text" id="searchInput" placeholder="Rechercher par ID">
                <button onclick="searchBook()">Rechercher</button>

                <table class="mystock_table">
                    <tr>
                        <th>Identifiant</th>
                        <th>Titre</th>
                        <th>Genre</th>
                        <th>Auteur</th>
                        <th>Est emprunté ?</th>
                    </tr>
                    <?php
                    // Identifiant de connexion à la BDD
                    $serveur = "localhost";
                    $utilisateur = "root";
                    $motDePasse = "";
                    $baseDeDonnees = "ecoline_books";

                    // Connexion à la BDD avec les identifiants
                    $connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);
                    if (!$connexion) {
                        die("Échec de la connexion : " . mysqli_connect_error());
                    }
                    // Requête pour récupérer des données
                    $requete_books = "SELECT barcode, title, genre, author, is_borrowed FROM books";
                    $resultat_books = $connexion->query($requete_books);

                    if ($resultat_books->num_rows > 0) {
                        while ($row = $resultat_books->fetch_assoc()) {
                            echo "<tr id='row-" . htmlspecialchars($row["barcode"], ENT_QUOTES, 'UTF-8') . "'>";
                            echo "<td><a href='books.php?id=" . htmlspecialchars($row["barcode"], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row["barcode"], ENT_QUOTES, 'UTF-8') . "</a></td>";
                            echo "<td>" . htmlspecialchars($row["title"], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td>" . htmlspecialchars($row["genre"], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td>" . htmlspecialchars($row["author"], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td>" . htmlspecialchars($row["is_borrowed"], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>0 résultats</td></tr>";
                    }
                    $connexion->close();
                    ?>
                </table>
            </div>
        </div>
    </div>

    <script>
        function searchBook() {
            var input = document.getElementById("searchInput").value;
            var row = document.getElementById("row-" + input);
            if (row) {
                row.scrollIntoView({ behavior: "smooth" });
                row.classList.add("highlight");
            } else {
                alert("ID non trouvé");
            }
        }
    </script>
</body>
</html>
