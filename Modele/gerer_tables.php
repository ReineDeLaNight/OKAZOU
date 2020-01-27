<?php 
function afficherSite() {
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
    $req = $bdd -> prepare("SELECT * FROM site");
    $req -> execute();
    $listeMembres = $req -> fetchall();
    return $listeMembres;
}
function afficherMarque() {
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
    $req = $bdd -> prepare("SELECT * FROM marque");
    $req -> execute();
    $listeMembres = $req -> fetchall();
    return $listeMembres;
}
function ajouterSite() {
    $nom = $_GET['nom'];
    $lien = $_GET['lien'];
    $logo = $_GET['logo'];
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
    $req = $bdd -> prepare("INSERT INTO site (nom, lien, logo) VALUES (:nom, :lien, :logo)");
    $req->bindParam(':nom', $nom, PDO::PARAM_STR);
    $req->bindParam(':lien', $lien, PDO::PARAM_STR);
    $req->bindParam(':logo', $logo, PDO::PARAM_STR);
    $req -> execute() or die(print_r($req->errorInfo(), TRUE)); 
}
function ajouterMarque() {
    $marque = $_GET['marque'];
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
    $req = $bdd -> prepare("INSERT INTO marque (marque) VALUES (:marque)");
    $req->bindParam(':marque', $marque, PDO::PARAM_STR);
    $req -> execute() or die(print_r($req->errorInfo(), TRUE)); 
}
function afficherInfoSite($name) {
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
    $req = $bdd -> prepare("SELECT * FROM site WHERE nom LIKE :nom");
    $req->bindParam(':nom', $name, PDO::PARAM_STR);
    $req -> execute();
    $infoSite = $req -> fetch();
    return $infoSite;
}
?>