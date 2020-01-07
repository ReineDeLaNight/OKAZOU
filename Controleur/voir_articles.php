<?php 
session_start();
require("../Modele/voir_articles.php");
$infoArticle = afficherArticles();
if(isset($_SESSION['id'])){
    ajouterHistorique();
$favori = ajouterFavori(); 
}
require("../Vue/voir_articles.php");
?>