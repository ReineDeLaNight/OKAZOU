<?php 
session_start();

require("../Modele/voir_articles.php");
$infoArticle = afficherArticles();
$favori = ajouterFavori(); 
print_r($favori);
require("../Vue/voir_articles.php");
?>