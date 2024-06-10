<?php
if(isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];
    echo "Nom d'utilisateur: " . $username;
} else {
    echo "Le cookie 'username' n'existe pas.";
}
?>
