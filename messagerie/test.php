<!DOCTYPE html>
<html>
<head>
    <title>Envoyer un message</title>
    <style>
        form {
            margin: 20px;
        }
        input, textarea, select {
            display: block;
            margin-bottom: 10px;
            padding: 10px;
            width: 300px;
        }
    </style>
</head>
<body>
    <h2>Envoyer un message</h2>
    <form action="send_message.php" method="POST" enctype="multipart/form-data">
        <label for="recipient">Destinataire:</label>
        <select id="recipient" name="recipient" required>
            <option value="" disabled selected>Choisissez un destinataire...</option>
            <?php foreach ($users as $user): ?>
                <option value="<?php echo $user['id']; ?>"><?php echo $user['noms']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="hidden" id="destinataire_id" name="destinataire_id">
        
        <label for="message_content">Sujet:</label>
        <input type="text" id="message_content" name="message_content" required>
        
        <label for="message_text">Message:</label>
        <textarea id="message_text" name="message_text" rows="5" required></textarea>
        
        <label for="message_media">Document:</label>
        <input type="file" id="message_media" name="message_media">
        
        <input type="submit" value="Envoyer">
    </form>
</body>
</html>
