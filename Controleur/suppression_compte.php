<?php
    session_start();
    require("../Modele/suppression_compte.php");
    supprimer_compte($_SESSION["pseudo"]);
    session_destroy();
    header("Location:../accueil.php");
?>