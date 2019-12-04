<?php
    session_start();
    require("../Modele/suppression_compte.php");
    supprimer_compte($_SESSION["pseudo"]);
    
    include("../accueil.php");
?>