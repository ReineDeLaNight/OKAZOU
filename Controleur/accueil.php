<?php
    session_start();
    if (!isset($_SESSION['pseudo']) && !isset($_SESSION['mdp'])) {
        $_SESSION['tentativeConnexion'] = false;
    }
    include("../Vue/accueil.php");
?>

