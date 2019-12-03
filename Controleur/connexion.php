<?php
    
    $erreurAff = "";
    if (empty($_GET["pseudo"]) && empty($_GET["mdp"]) && !isset($_GET['premiereConnexion'])) { // Pour diriger l'utilisateur la première fois
        include("../Vue/connexion.php");
    } else if ((empty($_GET["pseudo"]) || empty($_GET["mdp"])) && $_GET['premiereConnexion'] == false) {
        $erreurAff = "Champs incorrects ou incomplets";
        include("../Vue/connexion.php");
    } else {
        include_once("../Modele/connexion.php");
        if (testConnexion($_GET["pseudo"], $_GET["mdp"])) {
            include("../Controleur/accueil.php");
        } else {
            $erreurAff = "Champs incorrects ou incomplets";
            include("../Controleur/connexion.php");
        }
    }


?>