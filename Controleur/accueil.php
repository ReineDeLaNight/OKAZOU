<?php
    session_start();
    if (!isset($_SESSION['etatConnexion'])) {
        $_SESSION['etatConnexion'] = false;
    }
    include("../Vue/accueil.php");  
?>

