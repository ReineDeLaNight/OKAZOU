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
    $j = 0;
    for($i=0; $i<sizeof($item) ;$i++) {
        if($i==$j){
            $article = $article.'<div class="groupeArticle">';
            $j+=5;
        }
        $article = $article.$item[$i];
        if($i==$j-1){
            $article = $article.'</div>';
        }
    }
}
include("../Vue/voir_favoris.php");
?>