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
        @import url(books.css);
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        .highlight {
            background-color: #ffff99;
        }
    </style>
</head>

<body>
    <?php
        $serveur = "localhost";
        $utilisateur = "root";
        $motDePasse = "";
        $baseDeDonnees = "ecoline_books";

        $connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);
        if ($connexion->connect_error) {
            die("Échec de la connexion : " . $connexion->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
            $id = $connexion->real_escape_string($_POST['id']);

            // Requête pour récupérer le titre du livre avant de le supprimer
            $requete_book_title = "SELECT title FROM books WHERE barcode = '$id'";
            $resultat_book_title = $connexion->query($requete_book_title);

            if ($resultat_book_title && $resultat_book_title->num_rows > 0) {
                $row = $resultat_book_title->fetch_assoc();
                $book_title = $connexion->real_escape_string($row['title']);

                // Vérification que $book_title et $id ne sont pas vides
                if (empty($book_title) || empty($id)) {
                    echo "Erreur : le titre du livre ou l'ID est vide.";
                    exit();
                }

                // Requête pour supprimer le livre
                $sql = "DELETE FROM books WHERE barcode = '$id'";
                if ($connexion->query($sql) === TRUE) {
                    // Mise à jour de l'historique
                    $date = date('Y-m-d');
                    $type = "suppression";
                    $requete_history = "INSERT INTO history (ID, transac_date, transac_type, bookdata) VALUES ('$id', '$date', '$type', '$book_title')";
                    
                    // Affichage de la requête d'historique pour le débogage
                    echo "Requête d'historique : " . $requete_history . "<br>";

                    if ($connexion->query($requete_history) === TRUE) {
                        header("Location: mystock.php");
                        exit();
                    } else {
                        echo "Erreur lors de l'insertion dans l'historique : " . $connexion->error;
                    }
                } else {
                    echo "Erreur lors de l'exécution de la requête : " . $connexion->error;
                }
            } else {
                echo "Livre non trouvé.";
            }
        }
    ?>
    <div class="container-all">
        <?php include '../../components/sidebar.php'; ?>

        <div class="main">
            <div class="head">
                <div class="logo-block">
                    <img src="/image/logo-ecoline.png">
                </div>
            </div>
            <div class="mystock_shortcut">
            <a href="mystock.php"><button> Retour</button></a>
                <table>
                    <tr>
                        <th>Identifiant</th>
                        <th>Titre</th>
                        <th>Est un livre ?</th>
                        <th>Genre</th>
                        <th>Auteur</th>
                        <th>ISBN</th>
                        <th>Est emprunté ?</th>
                        <th>ID Emprunteur</th>
                        <th>Action</th>
                    </tr>
                <?php
                    $id = $connexion->real_escape_string($_GET['id']);
                    $requete_books = "SELECT barcode, title, is_book, genre, author, isbn, is_borrowed, users_id FROM books WHERE barcode = '$id'";
                    $resultat_books = $connexion->query($requete_books);
                    if ($row = $resultat_books->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["barcode"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["title"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["is_book"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["genre"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["author"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["isbn"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["is_borrowed"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["users_id"]) . "</td>";
                        echo "<td>
                                <form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . htmlspecialchars($id) . "'>
                                    <input type='hidden' name='id' value='" . htmlspecialchars($row["barcode"]) . "' />
                                    <button type='submit' name='delete'>Supprimer</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    } else {
                        echo "<tr><td colspan='9'>Aucun livre trouvé</td></tr>";
                    }
                ?>
                </table>
                <div class="books_action">
                    <form action="data_add.php" method="post">
                        <div class="field">
                            <input name="book_ID" id="book_ID" type="text" placeholder="Code barre : "/>
                        </div>
                        <div class="field">
                            <input name="book_name" id="book_name" type="text" placeholder="Nom du livre"/>
                        </div>
                        <div class="field">
                            <input name="book_author" id="book_author" type="text" placeholder="Auteur du livre"/>
                        </div>
                        <div class="field">
                            <input name="book_isbn" id="book_isbn" type="text" placeholder="Code ISBN"/>
                        </div>
                        <button type="submit">Valider</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
