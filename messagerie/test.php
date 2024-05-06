<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style type="text/css">
        @import url(/github/messagerie/test.css); 
      

   
    </style>
</head>
<body>

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

</body>
</html>






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
                       






