<?php

function ajout_articles() {
    $description = $_GET['description'];
    $prix = $_GET['prix'];
    $keyword = $_GET['keyword'];
    $couleur = $_GET['couleur'];
    $etat = $_GET['etat'];
    $photo1 = $_GET['photo1'];
    $photo2 = $_GET['photo2'];
    $photo3 = $_GET['photo3'];
    $categorie = $_GET['categorie'];
    $taille = $_GET['taille'];
    $site = $_GET['site'];
    $marque = $_GET['marque'];
    
    $bdd = new PDO("mysql:host=localhost;dbname=okazou","root","");
    if(substr($categorie,0, 1) == "h") {
        $idPere = 1;
        $majCategorie = substr($categorie, 1);
    } else if (substr($categorie,0, 1) == "f") {
        $idPere = 2;
        $majCategorie = substr($categorie, 1); 
    } else if (substr($categorie,0, 1) == "e") {
        $idPere = 3;
        $majCategorie = substr($categorie, 1); 
    }
    $req1 = $bdd->prepare("SELECT id FROM categorie WHERE nom_categorie LIKE :majCategorie AND pere LIKE :idPere");
    $req1 ->bindParam(':idPere', $idPere, PDO::PARAM_INT);
    $req1 ->bindParam(':majCategorie', $majCategorie, PDO::PARAM_STR);
    $req1 -> execute();
    $idCategorie = $req1 -> fetch();
    $idCategorie = $idCategorie[0];
    echo($idCategorie."<br>");

    $req2 = $bdd -> prepare("SELECT id FROM site WHERE nom LIKE :site");
    $req2 ->bindParam(':site', $site, PDO::PARAM_STR);
    $req2 -> execute();
    $idSite = $req2 -> fetch();
    $idSite = $idSite[0];
    echo($idSite."<br>");
    
    if(substr($taille,0, 1) == "h") {
        $categorieTaille = "hauts";
        $majTaille = substr($taille, 1);
    } else if (substr($taille,0, 1) == "c") {
        $categorieTaille = "chaussure";
        $majTaille = substr($taille, 1); 

    } else if (substr($taille,0, 1) == "p") {
        $categorieTaille = "pantalons";
        $majTaille = substr($taille, 1); 
    } else if (substr($taille,0, 1) == "ch") {
        $categorieTaille = "chapeau";
        $majTaille = substr($taille, 1); 
    }
    $req3 = $bdd -> prepare("SELECT id FROM taille WHERE taille LIKE :majTaille AND categorie LIKE :categorieTaille");
    $req3 ->bindParam(':categorieTaille', $categorieTaille, PDO::PARAM_STR);
    $req3 ->bindParam(':majTaille', $majTaille, PDO::PARAM_STR);
    $req3 -> execute();
    $idTaille = $req3 -> fetch();
    $idTaille = $idTaille[0];
    echo($idTaille);

    $req4 = $bdd -> prepare("SELECT id FROM marque WHERE marque LIKE :marque");
    $req4 ->bindParam(':marque', $marque, PDO::PARAM_STR);
    $req4 -> execute();
    $idMarque = $req4 -> fetch();
    $idMarque = $idMarque[0];
    echo($idMarque);

    $reqAjout = $bdd -> prepare("INSERT INTO article(description, prix, keyword, couleur, etat, photo1, photo2, photo3, taille, categorie, site, marque) VALUES (:description, :prix, :keyword, :couleur, :etat, :photo1, :photo2, :photo3, :idTaille, :idCategorie, :idSite, :idMarque)");
    $reqAjout ->bindParam(':description', $description,  PDO::PARAM_STR);
    $reqAjout ->bindParam(':prix', $prix,  PDO::PARAM_INT);
    $reqAjout ->bindParam(':couleur', $couleur,  PDO::PARAM_STR);
    $reqAjout ->bindParam(':etat', $etat,  PDO::PARAM_STR);
    $reqAjout ->bindParam(':photo1', $photo1,  PDO::PARAM_STR);
    $reqAjout ->bindParam(':photo2', $photo2,  PDO::PARAM_STR);
    $reqAjout ->bindParam(':photo3', $photo3,  PDO::PARAM_STR);
    $reqAjout ->bindParam(':keyword', $keyword,  PDO::PARAM_STR);
    $reqAjout ->bindParam(':idTaille', $idTaille,  PDO::PARAM_INT);
    $reqAjout ->bindParam(':idCategorie', $idCategorie,  PDO::PARAM_INT);
    $reqAjout ->bindParam(':idSite', $idSite,  PDO::PARAM_INT);
    $reqAjout ->bindParam(':idMarque', $idMarque,  PDO::PARAM_INT);
    $reqAjout -> execute(); 
    
    echo($description);
    echo($prix);
    echo($couleur);
    echo($etat);
    echo($photo1);
    echo($idTaille);
    echo($idCategorie);
    echo($idSite);
    echo($idMarque);
}
?>
