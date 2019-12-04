
<?php
    session_start();
    $erreurAff = "";
    if ((empty($_GET["pseudo"]) && empty($_GET["mdp"])) && !isset($_GET['premiereConnexion'])) { // Pour diriger l'utilisateur la première fois
        include("../Vue/connexion.php");

    } else if ((empty($_GET["pseudo"]) || empty($_GET["mdp"])) && !$_GET['premiereConnexion']) {
        $erreurAff = "Champs incorrects ou incomplets";
        include("../Vue/connexion.php");

    } else {
        require("../Modele/connexion.php");
        $resultat = testConnexion($_GET["pseudo"], $_GET["mdp"]);
        
        if ($resultat) {
            $_SESSION['etatConnexion'] = true;
            $_SESSION["pseudo"] = $pseudo;
            $_SESSION["mdp"] = $mdp;
            header("Location:../accueil.php");
            
        } else {
            $erreurAff = "Champs incorrects ou incomplets";
            include("../Vue/Connexion.php");
        }
    }


?>