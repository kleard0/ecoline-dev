
<!--Ecoline-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <!--Meta-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Messagerie</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
    
    <!--Icon font Google-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!--CSS-->
    <!--Changer les paths des fichiers styles pour la fin du projet-->
    <style type="text/css">
        @import url(/github/messagerie/style.css); 
        @import url(sidebar.css);
        @import url(icons.css);

    h1 {
    text-align: center;
    }
    </style>
    
</head>
<!--Body-->
<body>
    <div class="container-all">
        <!--Sidebar-->
        <div class="sidebar">
            <div class="section-container">
                <div class="section">
                    <span class="material-symbols-outlined">
                        menu
                        </span>
                        <span><a href="/index.html">Accueil</a>
                </div>
                <div class="section">
                    <span class="material-symbols-outlined">
                        mail
                        </span>
                        <span><a href="index.php">Messagerie</a>
                        </span>
                </div>
                <div class="section">
                    <span class="material-symbols-outlined">
                        calendar_today
                        </span>
                        <span>Planning</span>
                </div>
                <div class="section">
                    <span class="material-symbols-outlined">
                        book_2
                        </span>
                        <span> Agenda</span>
                </div>
                <div class="section">
                    <span class="material-symbols-outlined">
                        school
                        </span>
                        <span>Note</span>
                </div>
                <div class="section">
                    <span class="material-symbols-outlined">
                        shopping_bag
                        </span>
                        <span>Gestion</span>
                </div>
                <div class="section">
                    <span class="material-symbols-outlined">
                        restaurant
                        </span>
                        <span> Repas</span>
                </div>
            </div>
        </div>
        <p style="font-family:Arial">
        <div class="main">
            <div class="head">
                <div class="logo-block">
                    <img src="image/logo-ecoline.png">
                </div>
                <div class="name-box">
                </div>
            </div>
            <div class="main-container">
                <div class="container">
                    <h1 style="font-family:Arial, Helvetica, sans-serif ";>Boîte de réception</h1>
                    
                    <div class="button-container">
                            <a href="formulaire.php" class="rounded-button">Nouveau message</a>
                        </div>
                    </div>

                    <?php
                    // Connect to your database
                    $servername = "localhost";
                    $username = "message";
                    $password = "4VZzATv&jiCV5Jo*5m5i@!X^#PbK9ijx";
                    $dbname = "test";

                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch data from the database
                    $sql = "SELECT firstname, lastname, message_text FROM helloworld";
                    $result = $conn->query($sql);

                    // Display the data
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<p>First Name: " . $row["firstname"] . "</p>";
                            echo "<p>Last Name: " . $row["lastname"] . "</p>";
                            echo "<p>Message: " . $row["message_text"] . "</p>";
                            echo "<table>";
                            echo "<tr><th>First Name</th><th>Last Name</th><th>Message</th></tr>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["firstname"] . "</td>";
                                echo "<td>" . $row["lastname"] . "</td>";
                                echo "<td>" . $row["message_text"] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                    } else {
                        echo "No data found.";
                    }

                
                    // Close the database connection
                   
                    ?>

                    <div class="view-message">  <!--carré blanc-->
                      
                       
                        
                    </div>

                </div>

            </div>                
        </div>

    </div>
    
</body>
</html>


