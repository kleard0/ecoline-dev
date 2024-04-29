
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
    <style type="text/css">
        @import url(style.css);
        @import url(sidebar.css);
        @import url(icons.css);
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
                        <span>Repas</span>
                </div>
            </div>
        </div>

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
                    


                    <div class="view-message">  <!--carré blanc-->
                        <form method="post" action="">
                            <label for="firstname">Prénom:</label>
                            <input type="text" name="firstname" id="firstname" required><br><br>
                            
                            <label for="lastname">Nom:</label>
                            <input type="text" name="lastname" id="lastname" required><br><br>
                            
                            <label for="message_text">Message:</label>
                            <input type="message_text" name="message_text" id="message_text" required><br><br>
                            
                            <input type="submit" value="Enregistrer">
                        </form>
                        
                        <?php
                        $servername = "localhost";
                        $username = "message";
                        $password = "4VZzATv&jiCV5Jo*5m5i@!X^#PbK9ijx";
                        $dbname = "test";
                
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $firstname = $_POST["firstname"];
                            $lastname = $_POST["lastname"];
                            $message_text = $_POST["message_text"];
                
                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection SQL
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                
                            $sql = "INSERT INTO helloworld (firstname, lastname, message_text)
                            VALUES ('$firstname', '$lastname', '$message_text')";
                
                            if ($conn->query($sql) === TRUE) {
                                echo "Message enregistré avec succès";
                            } else {
                                echo "Erreur SQL" . $sql . "<br>" . $conn->error;
                            }
                
                            $conn->close(); 
                        }
                        ?>
                    </div>


                       
                        
                    <button onclick="history.back()">Retour</button>


                </div>



            </div>                
        </div>

    </div>

</body>
</html>


