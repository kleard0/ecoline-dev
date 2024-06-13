<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Messagerie</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <!-- Icon font Google -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- CSS -->
    <style type="text/css">
        @import url(style.css);
        @import url(sidebar.css);
        @import url(formulaire.css); 
    </style>
    <script>
        function validateFileSize() {
            var fileInput = document.getElementById('message_media');
            var file = fileInput.files[0];

            if (file.size > 16 * 1024 * 1024) { // 16 MB in bytes
                alert('Le fichier est trop grand. La taille maximale autorisée est de 16 MB.');
                fileInput.value = ''; // Clear the input
                return false;
            }
            return true;
        }
    </script>
</head>
<!-- Body -->
<body>
    <div class="container-all">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="section-container">
                <div class="section">
                    <span class="material-symbols-outlined">
                        menu
                    </span>
                    <span><a href="/home.php">Accueil</a></span>
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
                    <div class="view-message">  <!-- Carré blanc -->
                        <div class="container">
                            <h1>Envoyer un message</h1>
                        </div>
                        <style>
                            form {
                                margin: 20px;
                            }
                            input, textarea, select {
                                display: block;
                                margin-bottom: 10px;
                                padding: 10px;
                            }
                        </style>
                        <h2>Envoyer un message</h2>
                        <form id="messageForm" action="send_message.php" method="POST" enctype="multipart/form-data" onsubmit="return validateFileSize()">
                            <label for="recipient">Destinataire:</label>
                            <select id="recipient" name="destinataire_id" required>
                                <option value="" disabled selected>Choisissez un destinataire...</option>
                                <option value="13">Élève</option>
                                <option value="14">Parent</option>
                                <option value="15">Professeur</option>
                                <option value="16">Direction</option>
                            </select>
                            
                            <label for="message_content">Sujet:</label>
                            <input type="text" id="message_content" name="message_content" required>
                            
                            <label for="message_text">Message:</label>
                            <textarea id="message_text" name="message_text" rows="5" required></textarea>
                            
                            <label for="message_media">Piece jointe, 16Mo maximum</label>
                            <input type="file" id="message_media" name="message_media">
                            
                            <input type="submit" value="Envoyer">
                        </form>
                    </div>
                </div>
            </div>                
        </div>
    </div>
</body>
</html>
