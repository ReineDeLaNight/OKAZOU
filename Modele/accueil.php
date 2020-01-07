<?php
function listeArticle() {
$bdd = new PDO("mysql:host=localhost;dbname=okazou","root","");
$req = $bdd->prepare("SELECT A.id, A.description, A.prix, A.keyword, A.couleur, A.etat, A.photo1, A.photo2, A.photo3, T.taille, T.categorie, C.nom_categorie, S.nom, M.marque FROM article A
INNER JOIN taille T on A.taille = T.id
INNER JOIN categorie AS C ON A.categorie = C.id
INNER JOIN site S ON A.site = S.id
INNER JOIN marque M ON A.marque = M.id WHERE A.id");
$req -> execute();
$listeArticle = $req -> fetchAll();
return $listeArticle;
}
function createItem($liste) {
    $item = '<div><a href ="Controleur\voir_articles.php?code='.$liste[0].'"><img src="Images/'.$liste[6].'"></div></a>';
    return $item;
}
?>