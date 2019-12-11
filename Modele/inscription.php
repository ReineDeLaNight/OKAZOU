<?php 


function verifMembres($erreurVerif) {
    $pseudo = $_GET['pseudo'];
    $bdd = new PDO("mysql:host=localhost;dbname=okazou","root","");
    $req = $bdd -> prepare("SELECT count(id) FROM membre WHERE pseudo LIKE :pseudo ");
    $req -> bindParam(':pseudo',$pseudo,PDO::PARAM_STR);
    $req -> execute();
    $test = $req -> fetch();
    if($test[0] == 1) {
        $erreurVerif[4] = ["Ce pseudo existe déjà", false];
        return $erreurVerif;
    }
    else {
        $erreurVerif[4] = ["", true];
        return $erreurVerif;   
    }
}

function verifVille($erreurVerif) {
    $ville = strtolower($_GET['ville']);
    $bdd = new PDO("mysql:host=localhost;dbname=okazou","root","");
    $req = $bdd -> prepare("SELECT count(id) FROM ville WHERE nom LIKE :ville ");
    $req -> bindParam(':ville',$ville,PDO::PARAM_STR);
    $req -> execute();
    $test = $req -> fetch();
    if($test[0] == 1) {
        $erreurVerif[5] = ["", true];
        return $erreurVerif;
    }
    else {
        $erreurVerif[5] = ["Cette ville n'existe pas", false];
        return $erreurVerif;   
    }
}


function ajoutInfos(){
    $pseudo = $_GET['pseudo'];
    $mdp = $_GET['mdp'];
    $sexe = $_GET['sexe'];
    $dateNaissance = $_GET['dateNaissance'];
    $ville = strtolower($_GET['ville']);
    $dateInscription = (date("Y-m-d"));
    
    $bdd = new PDO("mysql:host=localhost;dbname=okazou","root","");
    $Req2 = $bdd->prepare("SELECT id FROM ville WHERE nom LIKE :ville");
    $Req2 -> bindParam(':ville',$ville,PDO::PARAM_STR);
    $Req2 -> execute();
    $idVille = $Req2 -> fetch();

    $Req = $bdd->prepare("INSERT INTO membre(pseudo, mdp, sexe, date_naissance, date_inscription, ville) 
    VALUES(:pseudo, :mdp, :sexe, :dateNaissance, :dateInscription, :ville)");
    
    $Req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $Req->bindParam(':mdp', $mdp, PDO::PARAM_STR);
    $Req->bindParam(':sexe', $sexe, PDO::PARAM_STR);
    $Req->bindParam(':dateNaissance', $dateNaissance, PDO::PARAM_STR);
    $Req->bindParam(':dateInscription', $dateInscription, PDO::PARAM_STR);
    $Req->bindParam(':ville',$idVille[0], PDO::PARAM_STR);
    $Req->execute();
    
}
?>