<?php
function afficherProfil() {
    $bdd = new PDO("mysql:host=localhost;dbname=okazou","root","");
    $req = $bdd -> prepare("SELECT M.id, M.pseudo, M.mdp, M.date_naissance, M.sexe, V.nom FROM membre M JOIN ville V WHERE V.id LIKE M.ville AND M.id LIKE :id ");
    $req->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
    $req -> execute();
    $infoProfil = $req -> fetch();
    return $infoProfil;
}
function modifierProfil() {
    $mdp = $_GET['mdp'];
    $sexe = $_GET['sexe'];
    $dateNaissance = $_GET['dateNaissance'];
    $ville = strtolower($_GET['ville']);

    $bdd = new PDO("mysql:host=localhost;dbname=okazou","root","");
    $Req2 = $bdd->prepare("SELECT id FROM ville WHERE nom LIKE :ville");
    $Req2 -> bindParam(':ville',$ville,PDO::PARAM_STR);
    $Req2 -> execute();
    $idVille = $Req2 -> fetch();
    $req = $bdd -> prepare("UPDATE membre
    SET mdp = :mdp,
    date_naissance = :dateNaissance,
    sexe = :sexe,
    ville = :ville WHERE id LIKE :id");
    
    $req->bindParam(':mdp', $mdp, PDO::PARAM_STR);
    $req->bindParam(':sexe', $sexe, PDO::PARAM_STR);
    $req->bindParam(':dateNaissance', $dateNaissance, PDO::PARAM_STR);
    $req->bindParam(':ville',$idVille[0], PDO::PARAM_STR);
    $req->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
    $req -> execute();
    
}
function verifVille($erreurVerif) {
    $ville = strtolower($_GET['ville']);
    $bdd = new PDO("mysql:host=localhost;dbname=okazou","root","");
    $req = $bdd -> prepare("SELECT count(id) FROM ville WHERE nom LIKE :ville ");
    $req -> bindParam(':ville',$ville,PDO::PARAM_STR);
    $req -> execute();
    $test = $req -> fetch();
    if($test[0] == 1) {
        $erreurVerif[3] = ["", true];
        return $erreurVerif;
    }
    else {
        $erreurVerif[3] = ["Cette ville n'existe pas", false];
        return $erreurVerif;   
    }
}

?>