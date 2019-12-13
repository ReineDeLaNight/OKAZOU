<?php 
require("../Modele/voir_articles.php");
$infoArticle = afficherArticles();
require("../Vue/voir_articles.php");
?>