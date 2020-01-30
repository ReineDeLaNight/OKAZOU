<?php 
function afficherSite() {
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
    $req = $bdd -> prepare("SELECT * FROM site ORDER BY nom");
    $req -> execute();
    $listeMembres = $req -> fetchall();
    return $listeMembres;
}
function afficherMarque() {
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
    $req = $bdd -> prepare("SELECT * FROM marque ORDER BY marque");
    $req -> execute();
    $listeMembres = $req -> fetchall();
    return $listeMembres;
}
function afficherCategorie() {
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
    $req = $bdd -> prepare("SELECT DISTINCT nom_categorie FROM categorie ORDER BY nom_categorie");
    $req -> execute();
    $listeMembres = $req -> fetchall();
    return $listeMembres;
}
function afficherTaille() {
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
    $req = $bdd -> prepare("SELECT DISTINCT taille FROM taille ORDER BY taille.taille ASC
    ");
    $req -> execute();
    $listeMembres = $req -> fetchall();
    return $listeMembres;
}


function ajouterTaille() {
    $categorie = $_GET['categorie'];
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
    $req1 = $bdd -> prepare("SELECT * FROM categorie WHERE nom_categorie like :categorie");
    $req1 ->bindParam(':categorie', $categorie, PDO::PARAM_STR);
    $req1 -> execute();
    $categorie = $req1 -> fetch();
    $categorie = $categorie['id'];
    $taille = $_GET['taille'];
    $req = $bdd -> prepare("INSERT INTO taille (categorie, taille) VALUES (:categorie, :taille)");
    $req->bindParam(':categorie', $categorie, PDO::PARAM_INT);
    $req->bindParam(':taille', $taille, PDO::PARAM_STR);
    $req -> execute() or die(print_r($req->errorInfo(), TRUE)); 
}

function ajouterCategorie() {
    $categorie = $_GET['categorie'];
    $pere = $_GET['pere'];
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');

    $req = $bdd -> prepare("SELECT COUNT(*) FROM categorie WHERE nom_categorie = :categorie AND pere = :pere");
    $req->bindParam(':categorie', $categorie, PDO::PARAM_STR);
    $req->bindParam(':pere', $pere, PDO::PARAM_STR);
    $req -> execute() or die(print_r($req->errorInfo(), TRUE));
    $data = $req->fetch();
    
    if ($data[0] == 0) {
        $req = $bdd -> prepare("INSERT INTO categorie (nom_categorie, pere) VALUES (:categorie, :pere)");
        $req->bindParam(':categorie', $categorie, PDO::PARAM_STR);
        $req->bindParam(':pere', $pere, PDO::PARAM_STR);
        $req -> execute() or die(print_r($req->errorInfo(), TRUE)); 
    }
}
function ajouterSite() {
    $nom = $_GET['nom'];
    $lien = $_GET['lien'];
    $logo = $_GET['logo'];
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');

    $req = $bdd -> prepare("SELECT COUNT(*) FROM site WHERE nom = :nom OR lien = :lien OR logo = :logo");
    $req->bindParam(':nom', $nom, PDO::PARAM_STR);
    $req->bindParam(':lien', $lien, PDO::PARAM_STR);
    $req->bindParam(':logo', $logo, PDO::PARAM_STR);
    $req -> execute() or die(print_r($req->errorInfo(), TRUE)); 
    $data = $req->fetch();

    if ($data[0] == 0) {
        $req = $bdd -> prepare("INSERT INTO site (nom, lien, logo) VALUES (:nom, :lien, :logo)");
        $req->bindParam(':nom', $nom, PDO::PARAM_STR);
        $req->bindParam(':lien', $lien, PDO::PARAM_STR);
        $req->bindParam(':logo', $logo, PDO::PARAM_STR);
        $req -> execute() or die(print_r($req->errorInfo(), TRUE)); 
    }
}
function ajouterMarque() {
    $marque = $_GET['marque'];
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');

    $req = $bdd -> prepare("SELECT COUNT(*) FROM marque WHERE marque = :marque");
    $req->bindParam(':marque', $marque, PDO::PARAM_STR);
    $req -> execute() or die(print_r($req->errorInfo(), TRUE)); 
    $data = $req->fetch();

    if ($data[0] == 0) {
        $req = $bdd -> prepare("INSERT INTO marque (marque) VALUES (:marque)");
        $req->bindParam(':marque', $marque, PDO::PARAM_STR);
        $req -> execute() or die(print_r($req->errorInfo(), TRUE)); 
    }
}
function afficherInfoSite($name) {
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
    $req = $bdd -> prepare("SELECT * FROM site WHERE nom LIKE :nom");
    $req->bindParam(':nom', $name, PDO::PARAM_STR);
    $req -> execute();
    $infoSite = $req -> fetch();
    return $infoSite;
}

function sup_site($supprimer) {
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
    $req = $bdd -> prepare("DELETE FROM site WHERE nom LIKE :nom");
    $req->bindParam(':nom', $supprimer, PDO::PARAM_STR);
    $req -> execute();
}
function sup_categorie($supprimer) {
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
    $req = $bdd -> prepare("DELETE FROM categorie WHERE nom_categorie LIKE :nom");
    $req->bindParam(':nom', $supprimer, PDO::PARAM_STR);
    $req -> execute();
}
function sup_marque($supprimer) {
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
    $req = $bdd -> prepare("DELETE FROM marque WHERE nom LIKE :nom");
    $req->bindParam(':nom', $supprimer, PDO::PARAM_STR);
    $req -> execute();
}

function sup_taille($supprimer) {
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
    $req = $bdd -> prepare("DELETE FROM taille WHERE taille LIKE :nom");
    $req->bindParam(':nom', $supprimer, PDO::PARAM_STR);
    $req -> execute();
}
?>