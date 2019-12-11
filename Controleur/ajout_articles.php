<?php 
require("../Vue/ajout_articles.php");
require("../Modele/ajout_articles.php");
if(!empty($_GET['valide'])) {
    if(!empty($_GET['description']) && !empty($_GET['prix']) &&  !empty($_GET['couleur']) && !empty($_GET['etat']) && !empty($_GET['photo1']) && !empty($_GET['categorie']) && !empty($_GET['taille']) && !empty($_GET['site']) && !empty($_GET['marque'])) {
        ajout_articles();
        echo("locu");
    }
    else {
        echo("chatte");
    }
}

?>