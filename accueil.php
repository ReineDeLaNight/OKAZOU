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
        $item[$i] = '';
        $item[$i] = $item[$i].'<a href ="Controleur\voir_articles.php?code='.$listeArticle[$i][0].'"><img class = "article" src="'.$listeArticle[$i][6].'"></a>';
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
$articleCategorie = '';
$descriptif = '';
if(!empty($_GET['categorie']) && !empty($_GET['souscategorie'])) {
   $listeArticleCategorie = articleCategorie($_GET['categorie'],$_GET['souscategorie']);
   $descriptif = '<div><h1>'.$_GET['souscategorie'].' pour '.$_GET['categorie'].'</h1></div>';
   $articleCategorie = $articleCategorie.'<div id = "contentFlex">';
   for($i=0;$i < sizeof($listeArticleCategorie);$i++) {
    $articleCategorie = $articleCategorie.'<div><a href ="Controleur\voir_articles.php?code='.$listeArticleCategorie[$i][0].'"><img class = "article" src="'.$listeArticleCategorie[$i][1].'"></a></div>';
   }
   $articleCategorie = $articleCategorie.'</div>';
}
include("./Vue/accueil.php");
?>

