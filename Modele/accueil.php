<?php
function listeArticle() {
$bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
$req = $bdd->prepare("SELECT A.id, A.description, A.prix, A.keyword, A.couleur, A.etat, A.photo1, A.photo2, A.photo3, T.taille, T.categorie, C.nom_categorie, S.logo, M.marque FROM article A
INNER JOIN taille T on A.taille = T.id
INNER JOIN categorie AS C ON A.categorie = C.id
INNER JOIN site S ON A.site = S.id
INNER JOIN marque M ON A.marque = M.id WHERE A.id");
$req -> execute();
$listeArticle = $req -> fetchAll();

return $listeArticle;
}
    
function recupererCategorie() {
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
    $req1 = $bdd -> prepare("SELECT nom_categorie FROM categorie WHERE pere LIKE 1 ");
    $req1 -> execute();
    $categorie[0] = $req1 -> fetchall();
    $req2 = $bdd -> prepare("SELECT nom_categorie FROM categorie WHERE pere LIKE 2 ");
    $req2 -> execute();
    $categorie[1] = $req2 -> fetchall();
    $req3 = $bdd -> prepare("SELECT nom_categorie FROM categorie WHERE pere LIKE 3 ");
    $req3 -> execute();
    $categorie[2] = $req3 -> fetchall();
    
    return $categorie;
}
function articleCategorie($categorie,$sousCategorie) {
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
    $req1 = $bdd -> prepare("SELECT pere FROM categorie WHERE nom_categorie LIKE :categorie");
    $req1 -> bindParam(':categorie',$categorie,PDO::PARAM_STR);
    $req1 -> execute();
    $idPere = $req1 -> fetch();
    $idPere = $idPere[0];

    $req2 = $bdd -> prepare("SELECT * FROM article A
    INNER JOIN categorie AS C ON A.categorie = C.id
    INNER JOIN marque AS M ON A.marque = M.id
    WHERE C.nom_categorie LIKE :sousCategorie AND pere LIKE :idPere
    LIMIT 5");
    $req2 -> bindParam(':sousCategorie',$sousCategorie,PDO::PARAM_STR);
    $req2 -> bindParam(':idPere',$idPere,PDO::PARAM_INT);
    $req2 -> execute();
    $listeArticle = $req2 -> fetchAll();
    return $listeArticle;
}

function afficherFavori($codeArticle) {
    $membre = $_SESSION['id'];
    $flag = 'f';
    
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', ''); 
    $req1 = $bdd -> prepare("SELECT COUNT(id) FROM favori WHERE article LIKE :codeArticle AND membre LIKE :membre AND flag LIKE :flag");
    $req1 -> bindParam(':codeArticle', $codeArticle, PDO::PARAM_INT);
    $req1 -> bindParam(':membre', $membre, PDO::PARAM_INT);
    $req1 -> bindParam(':flag', $flag, PDO::PARAM_STR);
    $req1 -> execute(); 
    $test = $req1 -> fetch();
    if($test[0]==0) {
        $nomBouton = '♡';
        return $nomBouton;
        
    } else {
        $nomBouton = '♥';
        return $nomBouton;
    }
    
}

    
?>