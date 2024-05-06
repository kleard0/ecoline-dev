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
        @import url(/github/messagerie/test.css); 
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
                    <span><a href="/index.html">Accueil</a></span>
                </div>
                <div class="section">
                    <span class="material-symbols-outlined">
                        mail
                    </span>
                    <span><a href="index.php">Messagerie</a></span>
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
                    <span>Agenda</span>
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
                        <h2>Responsive Form</h2>
                        <p>Resize the browser window to see the effect. When the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other.</p>

                        <div class="container">
                            <form action="/action_page.php">
                                <div class="row">
                                    <div class="col-25">
                                        <label for="fname">First Name</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" id="fname" name="firstname" placeholder="Your name..">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label for="lname">Last Name</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" id="lname" name="lastname" placeholder="Your last name..">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label for="country">Country</label>
                                    </div>
                                    <div class="col-75">
                                        <select id="country" name="country">
                                            <option value="australia">Australia</option>
                                            <option value="canada">Canada</option>
                                            <option value="usa">USA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label for="subject">Subject</label>
                                    </div>
                                    <div class="col-75">
                                        <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <input type="submit" value="Submit">
                                </div>
                            </form>
                        </div>

                        <form method="post" action="">
                            <label for="destinataire_id">Destinataire ID:</label>
                            <input type="text" name="destinataire_id" id="destinataire_id" required><br><br>
                            
                            <label for="message_content">Sujet:</label>
                            <input type="text" name="message_content" id="message_content" required><br><br>
                            
                            <label for="message_text">Contenu du message:</label></br>
                            <textarea name="message_text" id="message_text" required></textarea><br><br>
                            
                            <!--  <label for="message_media">Pièce jointe:</label>
                            <input type="file" name="message_media" id="message_media"><br><br>
                            -->
                            <input type="submit" value="Envoyer le message">
                        </form>

                        <?php
                        $servername = "localhost";
                        $username = "message";
                        $password = "4VZzATv&jiCV5Jo*5m5i@!X^#PbK9ijx";
                        $dbname = "ecoline";

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $destinataire_id = $_POST["destinataire_id"];
                            $message_content = $_POST["message_content"];
                            $message_text = $_POST["message_text"];

                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection impossible à la base de données" . $conn->connect_error);
                            }

                            $sql = "INSERT INTO message (destinataire_id, message_content, message_text)
                            VALUES ('$destinataire_id', '$message_content', '$message_text')";

                            if ($conn->query($sql) === TRUE) {
                                echo "Message envoyé avec succès.";
                            } else {
                                echo "Erreur dans l'envoi du message." . $sql . "<br>" . $conn->error;
                            }

                            $conn->close(); 
                        }
                        ?>
                    </div>

                    <a href="index.php" class="rounded-button">Retour</a>
                </div>
            </div>                
        </div>
    </div>
</body>
</html>
