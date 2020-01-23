<?php
session_start();
require("../Modele/voir_prod_consult.php");
$listeArticle = listeArticle();
$article = 'Aucun produit consulté';
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
if(!empty($_GET['historique'])) {
    supprimerHistorique();
    $article = 'Aucun produit consulté';
}
require("../Vue/voir_prod_consult.php");
}
?>
