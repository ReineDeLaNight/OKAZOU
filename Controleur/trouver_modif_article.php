<?php
    if (!isset($_GET['nom_article'])) {
        $msgErreur = "";
        include("../Vue/trouver_modif_article.php");
    }else if (isset($_GET['nom_article'])) {
        $nom_article = $_GET['nom_article'];
        include("../Modele/trouver_article.php");
        if ($id = trouver_article($nom_article)) {
            header("Location:./modif_article.php?id=".$id."");
        } else {
            $msgErreur = "L'article n'a pas été trouvé";
            include("../Vue/trouver_modif_article.php");
        }
    }
    
?>