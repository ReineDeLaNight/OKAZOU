<?php 
function afficherArticles() {
    $codeArticle = $_GET['code'];
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', ''); 
    $req = $bdd -> prepare("SELECT * FROM article WHERE id LIKE :codeArticle");
    $req -> bindParam(':codeArticle', $codeArticle, PDO::PARAM_INT);
    $req -> execute();
    $infoArticle = $req -> fetch();
    $idTaille = $infoArticle[9];
    $idCategorie = $infoArticle[10];
    $idSite = $infoArticle[11];
    $idMarque = $infoArticle[12];

    $req2 = $bdd -> prepare("SELECT taille FROM taille WHERE id LIKE :idTaille");
    $req2 -> bindParam(':idTaille', $idTaille, PDO::PARAM_INT);
    $req2 -> execute();
    $infoTaille = $req2 -> fetch();
    $infoTaille = $infoTaille[0];

    $req3 = $bdd -> prepare("SELECT lien FROM site WHERE id LIKE :idSite");
    $req3 -> bindParam(':idSite', $idSite, PDO::PARAM_INT);
    $req3 -> execute();
    $infoSite = $req3 -> fetch();
    $infoSite = $infoSite[0];

    $req4 = $bdd -> prepare("SELECT nom_categorie FROM categorie WHERE id LIKE :idCategorie");
    $req4 -> bindParam(':idCategorie', $idCategorie, PDO::PARAM_INT);
    $req4 -> execute();
    $infoCategorie = $req4 -> fetch();
    $infoCategorie = $infoCategorie[0];

    $req5 = $bdd -> prepare("SELECT marque FROM marque WHERE id LIKE :idMarque");
    $req5 -> bindParam(':idMarque', $idMarque, PDO::PARAM_INT);
    $req5 -> execute();
    $infoMarque = $req5 -> fetch();
    $infoMarque = $infoMarque[0];
  
    
   $infoArticle[9] = $infoTaille;
   $infoArticle[11] = $infoSite;
   $infoArticle[12] = $infoMarque;
   $infoArticle[10] = $infoCategorie;
    
    
    return $infoArticle;
}
?>