<?php

function ajout_articles() {

    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');

    $nom = $_GET['nom'];
    $description = $_GET['description'];
    $lien = $_GET['lien'];
    $prix = $_GET['prix'];
    $couleur = $_GET['couleur'];
    $etat = $_GET['etat'];
    $photo1 = $_GET['photo1'];
    $photo2 = $_GET['photo2'];
    $photo3 = $_GET['photo3'];
    $choix_cat = $_GET['choix_cat'];
    $site = $_GET['site'];
    $marque = $_GET['marque'];
    
    
    if($choix_cat == "femmes") {
        $idPere = 1;  
    } else if ($choix_cat == "hommes") {
        $idPere = 2;
    } else if ($choix_cat == "enfants") {
        $idPere = 3;
    }
    $sous_cat = $_GET[$choix_cat];

    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', ''); 
    $req = $bdd -> prepare("SELECT DISTINCT nom_categorie FROM categorie");

    $req -> execute() or die(print_r($req->errorInfo(), TRUE));
    
    $liste_cat = $req->fetchall();
    
    unset($liste_cat[0]);
    unset($liste_cat[1]);
    unset($liste_cat[2]);

    $liste_cat = array_values($liste_cat);

    for ($i = 0; $i < sizeof($liste_cat); $i++) {
        if ($liste_cat[$i][0] == $sous_cat) {
            break;
        }
    }    

    $taille = $_GET[$i];

    //echo $taille;

    $req1 = $bdd->prepare("SELECT id FROM categorie WHERE nom_categorie = :sous_cat AND pere = :idPere");
    $req1 ->bindParam(':idPere', $idPere, PDO::PARAM_INT);
    $req1 ->bindParam(':sous_cat', $sous_cat, PDO::PARAM_STR);
    $req1 -> execute() or die(print_r($req->errorInfo(), TRUE));
    $idCategorie = $req1 -> fetch();
    $idCategorie = $idCategorie[0];
    //echo $idCategorie;

    $req2 = $bdd -> prepare("SELECT id FROM site WHERE nom LIKE :site");
    $req2 ->bindParam(':site', $site, PDO::PARAM_STR);
    $req2 -> execute();
    $idSite = $req2 -> fetch();
    $idSite = $idSite[0];
    //echo($idSite."<br>");
    

    echo $idCategorie;
    echo $taille."<br>";
    $req3 = $bdd -> prepare("SELECT id FROM taille WHERE taille LIKE :taille AND categorie LIKE :idCategorie");
    $req3 ->bindParam(':idCategorie', $idCategorie, PDO::PARAM_INT);
    $req3 ->bindParam(':taille', $taille, PDO::PARAM_STR);
    $req3 -> execute() or die(print_r($req3->errorInfo(), TRUE));
    $idTaille = $req3 -> fetch();
    $idTaille = $idTaille[0];
    //echo($idTaille);

    $req4 = $bdd -> prepare("SELECT id FROM marque WHERE marque LIKE :marque");
    $req4 ->bindParam(':marque', $marque, PDO::PARAM_STR);
    $req4 -> execute();
    $idMarque = $req4 -> fetch();
    $idMarque = $idMarque[0];
    //echo($idMarque);
    
    $reqAjout = $bdd -> prepare("INSERT INTO article(nom, description, lien, prix, couleur, etat, photo1, photo2, photo3, taille, categorie, site, marque) VALUES (:nom, :description, :lien, :prix, :couleur, :etat, :photo1, :photo2, :photo3, :idTaille, :idCategorie, :idSite, :idMarque)");
    $reqAjout ->bindParam(':nom', $nom,  PDO::PARAM_STR);
    $reqAjout ->bindParam(':description', $description,  PDO::PARAM_STR);
    $reqAjout ->bindParam(':lien', $lien,  PDO::PARAM_STR);
    $reqAjout ->bindParam(':prix', $prix,  PDO::PARAM_INT);
    $reqAjout ->bindParam(':couleur', $couleur,  PDO::PARAM_STR);
    $reqAjout ->bindParam(':etat', $etat,  PDO::PARAM_STR);
    $reqAjout ->bindParam(':photo1', $photo1,  PDO::PARAM_STR);
    $reqAjout ->bindParam(':photo2', $photo2,  PDO::PARAM_STR);
    $reqAjout ->bindParam(':photo3', $photo3,  PDO::PARAM_STR);
    $reqAjout ->bindParam(':idTaille', $idTaille,  PDO::PARAM_INT);
    $reqAjout ->bindParam(':idCategorie', $idCategorie,  PDO::PARAM_INT);
    $reqAjout ->bindParam(':idSite', $idSite,  PDO::PARAM_INT);
    $reqAjout ->bindParam(':idMarque', $idMarque,  PDO::PARAM_INT);
    $reqAjout -> execute() or die(print_r($reqAjout->errorInfo(), TRUE));
    
    /*echo($description);
    echo($prix);
    echo($couleur);
    echo($etat);
    echo($photo1);
    echo($idTaille);
    echo($idCategorie);
    echo($idSite);
    echo($idMarque);*/
}

function liste_cat() {
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', ''); 
    $req = $bdd -> prepare("SELECT nom_categorie, pere FROM categorie");

    $req -> execute() or die(print_r($req->errorInfo(), TRUE));
    
    $liste_cat = $req->fetchall();

    return $liste_cat;
}

function get_taille() {
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', ''); 
    $req = $bdd -> prepare("SELECT taille, categorie FROM taille");

    $req -> execute() or die(print_r($req->errorInfo(), TRUE));
    
    $liste_taille = $req->fetchall();

    for ($i = 0; $i <sizeof($liste_taille); $i++) {
        $req = $bdd -> prepare("SELECT nom_categorie FROM categorie WHERE id = :id");
        $req ->bindParam(':id', $liste_taille[$i][1],  PDO::PARAM_INT);

        $req -> execute() or die(print_r($req->errorInfo(), TRUE));
        
        $var = $req->fetch();
    
        $liste_taille[$i][1] = $var[0];

    }

    return $liste_taille;
}

function liste_cat_U() {
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', ''); 
    $req = $bdd -> prepare("SELECT DISTINCT nom_categorie FROM categorie");

    $req -> execute() or die(print_r($req->errorInfo(), TRUE));
    
    $liste_cat = $req->fetchall();

    return $liste_cat;
}

function get_marque() {
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', ''); 
    $req = $bdd -> prepare("SELECT marque FROM marque");

    $req -> execute() or die(print_r($req->errorInfo(), TRUE));
    
    $liste_marque = $req->fetchall();

    return $liste_marque;
}
?>
