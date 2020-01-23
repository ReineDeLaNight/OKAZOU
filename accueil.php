<?php
session_start();
include("./Modele/accueil.php");
if (!isset($_SESSION['etatConnexion'])) {  // Si l'utilisateur n'est pas connecté
    $_SESSION['etatConnexion'] = false;
    $boutonUtilisateur = 
    '<form action="./Controleur/connexion.php">
    <button type="submit">Connexion</button>
    </form>
    <form action="./Controleur/inscription.php">
    <button type="submit">Inscription</button>
    </form>';
} else if ($_SESSION['etatConnexion'] == true && $_SESSION['role'] == 'a') { // Si l'utilisateur est admin
    $boutonUtilisateur = 
    '<form action="./Controleur/voir_profil.php">
    <button type="submit">Voir le profil</button>
    </form>
    <form action="./Controleur/deconnexion.php">
    <button type="submit">Se déconnecter</button>
    </form>
    <form action="./Vue/action_admin.php">
    <button type="submit">Page de contrôle admin</button>
    </form>
    <form action="./Controleur/voir_prod_consult.php">
    <button type="submit">Historique</button>
    </form>
    <form action="./Controleur/voir_favoris.php">
    <button type="submit">Favoris</button>
    </form>';
} else if ($_SESSION['etatConnexion'] == true) { // Si l'utilisateur est connecté
    $boutonUtilisateur = 
    '<form action="./Controleur/voir_profil.php">
    <button type="submit">Voir le profil</button>
    </form>
    <form action="./Controleur/deconnexion.php">
    <button type="submit">Se déconnecter</button>
    </form>
    <form action="./Controleur/voir_prod_consult.php">
    <button type="submit">Historique</button>
    </form>
    <form action="./Controleur/voir_favoris.php">
    <button type="submit">Favoris</button>
    </form>';
} else { // A voir ce que ça fait là
    $_SESSION['etatConnexion'] = false;
    $boutonUtilisateur = 
    '<form action="./Controleur/connexion.php">
    <button type="submit">Connexion</button>
    </form>
    <form action="./Controleur/inscription.php">
    <button type="submit">Inscription</button>
    </form>';
}
$listeArticle = listeArticle();
for($i=0; $i<sizeof($listeArticle) ;$i++)
{
    $nomBouton[$i] = '';
    if(isset($_SESSION['id'])) {
        $nomBouton[$i] = afficherFavori($listeArticle[$i][0]);
    }
    $item[$i] = '';
    $item[$i] = $item[$i].'<div class ="articles">
    <a href ="Controleur\voir_articles.php?code='.$listeArticle[$i][0].'">
    <img id = "photo" src="'.$listeArticle[$i][6].'">
    </a>
    <div class="infos">
    <span id="categorie">'.$listeArticle[$i]['marque'].'</span>
    <span id="couleur">'.$listeArticle[$i]['couleur'].'</span>
    <span id="prix">'.$listeArticle[$i]['prix'].'€</span>
    <span id="favori">'.$nomBouton[$i].'</span>
    </div>
    </div>';
}

$categorie = recupererCategorie();
$cat[0] = '';
$cat[1] = '';
$cat[2] = '';
for($i=0; $i<sizeof($categorie) ;$i++)
{
    for($j = 1; $j<sizeof($categorie[$i]);$j++) {
        $cat[$i] = $cat[$i].'<a href ="./accueil.php?categorie='.$categorie[$i][0][0].'&souscategorie='.$categorie[$i][$j][0].'">'.$categorie[$i][$j][0].'</a>';
    }
}

// html pour affichage filtre
$filtre = "";

$listeCat = liste_cat();
$listeMarque = liste_marque();

$filtre .= '<form href="./accueil.php">';
/*for ($i = 0; $i < $listeCat; $i++) {
    
}*/
$filtre .= "";
$filtre .= '</form>';


$articleCategorie = '';
$descriptif = '';
if(!empty($_GET['categorie']) && !empty($_GET['souscategorie']) && empty($_GET['filtre'])) {
    $listeArticleCategorie = articleCategorie($_GET['categorie'],$_GET['souscategorie']);
    $descriptif = '<div  class="desc" ><h1>'.$_GET['souscategorie'].' pour '.$_GET['categorie'].'</h1></div>';
    $articleCategorie = $articleCategorie.'<div id = "contentFlex">';
    for($i=0;$i < sizeof($listeArticleCategorie);$i++) {
        $nomBouton[$i] = '';
        if(isset($_SESSION['id'])) {
            $nomBouton[$i] = afficherFavori($listeArticleCategorie[$i][0]);
        }
        $articleCategorie = $articleCategorie.'<div class ="articles">
        <a href ="Controleur\voir_articles.php?code='.$listeArticleCategorie[$i][0].'">
        <img id = "photo" src="'.$listeArticleCategorie[$i]['photo1'].'">
        </a>
        <div class="infos">
        <span id="categorie">'.$listeArticleCategorie[$i]['marque'].'</span>
        <span id="couleur">'.$listeArticleCategorie[$i]['couleur'].'</span>
        <span id="prix">'.$listeArticleCategorie[$i]['prix'].'€</span>
        <span id="favori">'.$nomBouton[$i].'</span>
        </div>
        </div>';
    }
    $articleCategorie = $articleCategorie.'</div>';


} /*else if (!empty($_GET['filtre'])) {
    echo "salut";
}*/
include("./Vue/accueil.php");
?>

