
<!--Ecoline-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <!--Meta-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ecoline</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!--CSS-->
    <!--<style type="text/css">
        @import url('./style.css');
        @import url('icons.css');
        @import url('./components/sidebar.css');
    </style>-->
    
    <style>
        <?php include './style.css'; ?>
        <?php include './icons.css'; ?>
        <?php include './components/sidebar.css'; ?>
    </style>
    <!--FONT-->
    <style>
       @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');
    </style>
</head>
<!--Body-->
<body>
<!-- Ligne pour importer la sidebar -->
<div class="container-all">
    <?php include 'components\sidebar.php'; ?>
    <div class="main">
        <div class="head">
            <div class="logo-block">
                <img src="./image/logo-ecoline.png">
            </div>
            <div class="name-box">
            </div>
        </div>
        <div class="main-container">
            <div class="container"></div>
            <div class="container"></div>
            
            <div class="container"></div>
            <div class="container"></div>
        </div>                
    </div>
</div>
</body>
</html>

