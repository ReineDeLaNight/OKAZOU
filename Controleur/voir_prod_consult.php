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
for($i=0; $i<sizeof($item) ;$i++)
    {
        $article = $article.$item[$i];
    }
}
if(!empty($_GET['historique'])) {
    supprimerHistorique();
    $article = 'Aucun produit consulté';
}
require("../Vue/voir_prod_consult.php");
?>
