<?php
session_start();

// Je rajoute cette condition pour ne pas avoir d'erreur de variables non définies
// Je test si chaque variable existe
if (isset($_GET['pseudo']) && isset($_GET['mdp']) && isset($_GET['sexe']) && isset($_GET['dateNaissance']) && isset($_GET['ville'])) {
    $pseudo = $_GET['pseudo'];
    $mdp = $_GET['mdp'];
    $sexe = $_GET['sexe'];
    $dateNaissance = $_GET['dateNaissance'];
    $ville = $_GET['ville'];
}

if(!empty($_GET['SignUp'])) {
    $checkFinal = 0;
    // On déclare le tableau a deux dimesions
    $erreurVerif = array();
    $erreurVerif[] = [NULL , NULL];
    
    /* Déclaration de la fonction qui vérifie que tous les champs sont complets. Si il manque un ou plusieurs
    champs, on affecte à la case [0][0] le message d'erreur correspondant et a la case [0][1] la réponse false.
    */
    function champsComplets($erreurVerif) {
        
        if(!empty($_GET['pseudo']) && !empty($_GET['mdp']) && !empty($_GET['dateNaissance'])&& !empty($_GET['sexe'])) {
            $erreurVerif[0] = [ "", true ]; 
            return $erreurVerif;
        }
        else {
            $erreurVerif[0] = [ "Les champs ne sont pas remplis" , false ];
            return $erreurVerif;
        }
    }
    
    $erreurVerif = champsComplets($erreurVerif);
    
    function verifTaillePseudo($erreurVerif) {
        
        $taillePseudoMax = 45;
        $taillePseudoMin = 3;
        if(strlen($_GET['pseudo']) >= $taillePseudoMax || strlen($_GET['pseudo']) <= $taillePseudoMin) {
            $erreurVerif[1] = ["Le pseudo n'est pas correctement écrit (entre 4 et 45 caractères)", false];
            return $erreurVerif;
        } else {
            $erreurVerif[1] = [ "", true ];
            return $erreurVerif;
        }
    }
    $erreurVerif = verifTaillePseudo($erreurVerif);
    
    function verifTailleMdp($erreurVerif) {
        $tailleMdpMin = 3;
        $tailleMdpMax = 45;
        if(strlen($_GET['mdp']) >= $tailleMdpMax || strlen($_GET['mdp']) <= $tailleMdpMin) {
            $erreurVerif[2] = ["Le mot de passe n'est pas correctement écrit (entre 4 et 45 caractères)", false];
            return $erreurVerif;
        }
        else {
            $erreurVerif[2] = [ "", true ];
            return $erreurVerif;
        }
    }
    $erreurVerif = verifTailleMdp($erreurVerif);
    function verifDate($erreurVerif) {
        $dateNaissance = $_GET['dateNaissance'];
        $anneeNaissance = substr($dateNaissance, 0, 4);
        if ($anneeNaissance >= date("Y") || $anneeNaissance <= 1919) {
            $erreurVerif[3] = ["Date Incorrecte", false];
            return $erreurVerif;
        }
        else {
            $erreurVerif[3] = [ "", true ];
            return $erreurVerif;
        }  
    }
    $erreurVerif = verifDate($erreurVerif);
    
    require("../Modele/inscription.php");
    for($i = 0; $i < count($erreurVerif); $i++) {
        if($erreurVerif[$i][1] == true) {
            $checkFinal += 1;
        }
    }
    if($checkFinal == count($erreurVerif)) {
        $_SESSION['etatConnexion'] = true;
        $_SESSION['pseudo'] = $pseudo;
        ajoutInfos();
        header("Location:../accueil.php");
    }
   
}
require("../Vue/inscription.php");
?>