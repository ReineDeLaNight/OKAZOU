<?php 
require("../Modele/ajout_articles.php");

$liste_cat= liste_cat();

unset($liste_cat[0]);
unset($liste_cat[1]);
unset($liste_cat[2]);

$liste_cat = array_values($liste_cat);

$categorie = "";

for ($j = 0; $j < 3; $j++) {

    if ($j == 0) {
        $pere = ["femmes", 1];
        $categorie .= 'femmes: ';
    } else if ($j == 1) {
        $pere = ["hommes", 2];
        $categorie .= 'hommes: ';
    } else {
        $pere = ["enfants", 3];
        $categorie .= 'enfants: ';
    }

    

    $categorie .= '<p><select name="'.$pere[0].'">';

    for ($i = 0; $i < sizeof($liste_cat); $i++) {
        if ($liste_cat[$i][1] == $pere[1]) {
            $categorie .= '<option value="'.$liste_cat[$i][0].'"> '.$liste_cat[$i][0].' </option>';
        }
    }
    $categorie .= '</select></p>';

}


$liste_cat= liste_cat_U();

unset($liste_cat[0]);
unset($liste_cat[1]);
unset($liste_cat[2]);

$liste_cat = array_values($liste_cat);
$liste_taille = get_taille();

$taille = "";

$taille .= '</select></p>';
$taille .= "<p><b>Taille</b> (déterminer selon la catégorie choisie au préalable)<b>:</b></b></p>";

for ($i = 0; $i < sizeof($liste_cat); $i++) {
    $taille .= $liste_cat[$i][0];
    $taille .= '<p><select name="'.$i.'">';
    for ($j = 0; $j < sizeof($liste_taille); $j++) {
        
        if ($liste_taille[$j][1] == $liste_cat[$i][0]) {
            $taille .= '<option value="'.$liste_taille[$j][0].'"> '.$liste_taille[$j][0].' </option>';
        }
    }
    $taille .= '</select></p>';
}

$liste_marque = get_marque();
$marque = "";
$marque .= '<p><select name="marque">';
for ($i = 0; $i < sizeof($liste_marque); $i++) {
    $marque .= '<option value="'.$liste_marque[$i][0].'"> '.$liste_marque[$i][0].' </option>';
}
$marque .= '</select></p>';




if(!empty($_GET['valide'])) {
    if(!empty($_GET['nom']) && !empty($_GET['description']) && !empty($_GET['lien']) && !empty($_GET['prix']) && !empty($_GET['couleur']) && !empty($_GET['etat']) && !empty($_GET['photo1']) && !empty($_GET['choix_cat']) && !empty($_GET['site']) && !empty($_GET['marque'])) {
        ajout_articles();
    }
}



require("../Vue/ajout_articles.php");

?>