<?php 
session_start();
$url = $_SESSION['url'];
require("../Modele/voir_articles.php");
$infoArticle = afficherArticles();
if(isset($_SESSION['id'])){
    ajouterHistorique();
$favori = ajouterFavori(); 
}
require("../Vue/voir_articles.php");
?>