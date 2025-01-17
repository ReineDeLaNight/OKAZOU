<?php
function listeArticle() {
    $membre = $_SESSION['id'];
    $flag = 'f';
    $bdd = new PDO("mysql:host=localhost;dbname=okazou","root","");
    $req = $bdd->prepare("SELECT A.id, A.photo1 
    FROM article AS A
    INNER JOIN favori AS F ON F.article = A.id
    WHERE F.membre = :membre 
    AND F.flag = :flag");
    $req -> bindParam(':membre', $membre, PDO::PARAM_INT);
    $req -> bindParam(':flag', $flag, PDO::PARAM_STR);
    $req -> execute();
    $listeArticle = $req -> fetchAll();
    return $listeArticle;
}
function createItem($liste) {
    $item = '<div class="articles"><a href ="voir_articles.php?code='.$liste[0].'"><img id="photo" src="'.$liste[1].'"></a></div>';
    return $item;
}
?>