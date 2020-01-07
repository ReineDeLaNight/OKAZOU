<?php
session_start();
include("../Modele/voir_favoris.php");
$listeArticle = listeArticle();
$article = 'Aucun produit ajouté';
if(!empty($listeArticle)){
for($i=0; $i<sizeof($listeArticle) ;$i++)
    {
        $item[$i] = createItem($listeArticle[$i]);
    }
$article = '';
for($i=0; $i<sizeof($item) ;$i++)
    {
        $article = $article.$item[$i];
    }
}
include("../Vue/voir_favoris.php");
?>