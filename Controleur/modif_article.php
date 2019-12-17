<?php
    include("../Modele/modif_article.php");

    $attributs = aff_article($_GET["id"]);

    $erreur = [];
    $autocompletion = [];
    for ($i = 0; $i < sizeof($attributs); $i++) {
        if (empty($attributs[$i])) {
            $erreur[$i] = "NULL";
            $autocompletion[$i] = "";
        } else {
            $erreur[$i] = "";
            $autocompletion[$i] = $attributs[$i];
        }
        $erreur[$i];
    }


    $html = "";

    if (!isset($_GET['modif'])) {

        $html .= '<form action="modif_article.php" method="get">';

        $html .= "<div>&nbsp;description:&nbsp;&nbsp;".$attributs[1].$erreur[1].'&nbsp;&nbsp;-->&nbsp;&nbsp;<input type ="text" placeholder="description" name="description" value="'.$autocompletion[1].'"/>';
        $html .= "<div>&nbsp;prix:&nbsp;&nbsp;".$attributs[2].$erreur[2].'&nbsp;&nbsp;-->&nbsp;&nbsp;<input type ="number" placeholder="prix" name="prix" value="'.$autocompletion[2].'"/>';
        $html .= "<div>&nbsp;keyword:&nbsp;&nbsp;".$attributs[3].$erreur[3].'&nbsp;&nbsp;-->&nbsp;&nbsp;<input type ="text" placeholder="keyword" name="keyword" value="'.$autocompletion[3].'"/>';
        $html .= "<div>&nbsp;couleur:&nbsp;&nbsp;".$attributs[4].$erreur[4].'&nbsp;&nbsp;-->&nbsp;&nbsp;<input type ="text" placeholder="couleur" name="couleur" value="'.$autocompletion[4].'"/>';
        $html .= "<div>&nbsp;etat:&nbsp;&nbsp;".$attributs[5].$erreur[5].'&nbsp;&nbsp;-->&nbsp;&nbsp;<input type ="text" placeholder="etat" name="etat" value="'.$autocompletion[5].'"/>';
        $html .= "<div>&nbsp;photo1:&nbsp;&nbsp;".$attributs[6].$erreur[6].'&nbsp;&nbsp;-->&nbsp;&nbsp;<input type ="text" placeholder="photo1" name="photo1" value="'.$autocompletion[6].'"/>';
        $html .= "<div>&nbsp;photo2:&nbsp;&nbsp;".$attributs[7].$erreur[7].'&nbsp;&nbsp;-->&nbsp;&nbsp;<input type ="text" placeholder="photo2" name="photo2" value="'.$autocompletion[7].'"/>';
        $html .= "<div>&nbsp;photo3:&nbsp;&nbsp;".$attributs[8].$erreur[8].'&nbsp;&nbsp;-->&nbsp;&nbsp;<input type ="text" placeholder="photo3" name="photo3" value="'.$autocompletion[8].'"/>';
        $html .= "<div>&nbsp;taille:&nbsp;&nbsp;".$attributs[9].$erreur[9].'&nbsp;&nbsp;-->&nbsp;&nbsp;<input type ="text" placeholder="taille" name="taille"/>';
        $html .= "<div>&nbsp;categorie:&nbsp;&nbsp;".$attributs[10].$erreur[10].'&nbsp;&nbsp;-->&nbsp;&nbsp;<input type ="text" placeholder="categorie" name="categorie"/>';
        $html .= "<div>&nbsp;site:&nbsp;&nbsp;".$attributs[11].$erreur[11].'&nbsp;&nbsp;-->&nbsp;&nbsp;<input type ="text" placeholder="site" name="site"/>';
        $html .= "<div>&nbsp;marque:&nbsp;&nbsp;".$attributs[12].$erreur[12].'&nbsp;&nbsp;-->&nbsp;&nbsp;<input type ="text" placeholder="marque" name="marque"/>';
            
        $html .= '<div><button type="submit"> Confirmer </button></div>';
        $html .= '<input type="hidden" name="modif" value="1"/>';
        $html .= '<input type="hidden" name="id" value="'.$attributs[0].'"/>';
            
        $html .= "</form>";
            
        include("../Vue/modif_article.php");
    } else if ($_GET['modif'] == 1) {
        modif_article($attributs[0], $_GET['description'], $_GET['prix'], $_GET['keyword'], $_GET['couleur'], $_GET['etat'], $_GET['photo1'], $_GET['photo2'], $_GET['photo3'], $_GET['taille'], $_GET['categorie'], $_GET['site'], $_GET['marque']);
        header("Location:../Vue/action_admin.php");
    }
?>