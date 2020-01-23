<?php 
    session_start();
    require("../Modele/voir_profil.php");
    $erreurVerif = array();
    $erreurVerif[] = [NULL , NULL];
    $erreurVerif[0][0] = ""; 
    $erreurVerif[1][0] = ""; 
    $erreurVerif[2][0] = ""; 
    $erreurVerif[3][0] = ""; 
    $infoProfil = afficherProfil();
    $afficherProfil = '';
    $afficherProfil = '<ul class="w3-ul w3-border">
    <li>Pseudo : '.$infoProfil['pseudo'].'</li>
    <li>Mot de passe : '.$infoProfil['mdp'].'</li>
    <li>Sexe : '.$infoProfil['sexe'].'</li>
    <li>Date de Naissance : '.$infoProfil['date_naissance'].'</li>
    <li>Ville : '.$infoProfil['nom'].'</li>
    </ul>';
    if(!empty($_GET['modif']) && !empty($_GET['maj'])) {
    $checkFinal = 0;
    function champsComplets($erreurVerif) {
        
        if(!empty($_GET['mdp']) && !empty($_GET['dateNaissance'])&& !empty($_GET['sexe'])) {
            $erreurVerif[0] = [ "", true ]; 
            return $erreurVerif;
        }
        else {
            $erreurVerif[0] = [ "Les champs ne sont pas remplis" , false ];
            return $erreurVerif;
        }
    }
    
    $erreurVerif = champsComplets($erreurVerif);
    
    function verifTailleMdp($erreurVerif) {
        $tailleMdpMin = 3;
        $tailleMdpMax = 45;
        if(strlen($_GET['mdp']) >= $tailleMdpMax || strlen($_GET['mdp']) <= $tailleMdpMin) {
            $erreurVerif[1] = ["Le mot de passe n'est pas correctement écrit (entre 4 et 45 caractères)", false];
            return $erreurVerif;
        }
        else {
            $erreurVerif[1] = [ "", true ];
            return $erreurVerif;
        }
    }
    $erreurVerif = verifTailleMdp($erreurVerif);
    function verifDate($erreurVerif) {
        $dateNaissance = $_GET['dateNaissance'];
        $anneeNaissance = substr($dateNaissance, 0, 4);
        if ($anneeNaissance >= date("Y") || $anneeNaissance <= 1919) {
            $erreurVerif[2] = ["Date Incorrecte", false];
            return $erreurVerif;
        }
        else {
            $erreurVerif[2] = [ "", true ];
            return $erreurVerif;
        }  
    }
    
    $erreurVerif = verifDate($erreurVerif);

    $erreurVerif = verifVille($erreurVerif);    
    for($i = 0; $i < count($erreurVerif); $i++) {
        if($erreurVerif[$i][1] == true) {
            $checkFinal += 1;
        }
    }
    if($checkFinal == count($erreurVerif)) {
        modifierProfil();
        header("Location:./voir_profil.php");
    }
    }
require("../Vue/voir_profil.php"); 
?>