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
// récuperer une liste d'articles a afficher
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
    <span id="prix">'.$listeArticle[$i]['prix'].'€</span>
    <span id="favori">'.$nomBouton[$i].'</span>
    </div>
    </div>';
}
// Récuperer les catégories disponibles dans la BDD et les ranger dans le dropdown
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
// Recupérer les articles selon la catégorie choisie
$articleCategorie = '';
$descriptif = '';
if(!empty($_GET['categorie']) && !empty($_GET['souscategorie'])) {
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
        <span id="prix">'.$listeArticleCategorie[$i]['prix'].'€</span>
        <span id="favori">'.$nomBouton[$i].'</span>
        </div>
        </div>';
    }
    $articleCategorie = $articleCategorie.'</div>';
}
// Récupérer les produits conseillés si le mec est connecté
if(empty($_GET['categorie']) && $_SESSION['etatConnexion'] == true) {
    $nombreFavoris = nombreFavoris();
    if($nombreFavoris > 10) {
        $infoHisto = testAlgo($_SESSION['id']);
        for($i = 0; $i <sizeof($infoHisto); $i++){
            $id[$i] = $infoHisto[$i]['id'];
            $taille[$i] = $infoHisto[$i]['taille'];
            $couleur[$i] = $infoHisto[$i]['couleur'];
            $nom_categorie[$i] = $infoHisto[$i]['nom_categorie'];
        }
        $stats['taille'] = array_count_values($taille);
        $stats['couleur'] = array_count_values($couleur);
        $stats['nom_categorie'] = array_count_values($nom_categorie);
        
        foreach($stats['couleur'] as $key => $value)    
        {
            $tableCouleur[] = $key;
        }
        $tailleTab =  count($tableCouleur);
        for ($i=0; $i < $tailleTab ; $i++) { 
            $tableCouleurExplode[$i] = explode(", " ,$tableCouleur[$i]);
            if(strpos($tableCouleur[$i], ",")) {
                unset($tableCouleur[$i]);
            }
        }
        $tableCouleur= array_values($tableCouleur);
        
        for ($i=0; $i < count($tableCouleurExplode) ; $i++) { 
            
            for ($j=0; $j < count($tableCouleurExplode[$i]); $j++) { 
                
                for ($k=0; $k < count($tableCouleur) ; $k++) { 
                    if( !in_array($tableCouleurExplode[$i][$j],$tableCouleur) ) {
                        array_push($tableCouleur,$tableCouleurExplode[$i][$j]);
                    }
                    
                }
            }
        }
        
        foreach($tableCouleur as $key => $value) {
            $newTableCouleur[$value] = 0;
        }
        foreach($stats['couleur'] as $key => $value) {
            foreach($newTableCouleur as $key2 => $value2) {
                if($key == $key2) {
                    $newTableCouleur[$key2] += $value;
                }
                if(strpos($key, ",")) {
                    if(strpos(" ".$key, $key2)) {
                        $newTableCouleur[$key2] += $value/2;
                    } 
                }
            }
        }
        $stats['couleur'] = $newTableCouleur;
        array_multisort($stats['couleur'],SORT_DESC);
        array_multisort($stats['taille'],SORT_DESC);
        array_multisort($stats['nom_categorie'],SORT_DESC);
        
        
        $tailleTab = count($stats['couleur']);
        for($i=0; $i < $tailleTab - 4 ; $i++) { 
            array_pop($stats['couleur']);
        }
        $tailleTab = count($stats['taille']);
        for($i=0; $i < $tailleTab - 4 ; $i++) { 
            array_pop($stats['taille']);
        }
        $tailleTab = count($stats['nom_categorie']);
        for($i=0; $i < $tailleTab - 4 ; $i++) { 
            array_pop($stats['nom_categorie']);
        }
        $compteurTaille = 0;
        $compteurCouleur = 0;
        $compteurCategorie = 0;
        $nombreArticle = 0;
        $listeArticleConseilles = [];
        while($nombreArticle < 20) {
            $verif = 0;
            foreach($stats['taille'] as $key => $value) {
                if($compteurTaille == $verif) {
                    $taille = $key;
                }
                $verif++;
            }
            $verif = 0;
            foreach($stats['couleur'] as $key => $value) {
                if($compteurCouleur == $verif) {
                    $couleur = $key;
                }
                $verif++;
            }
            $verif = 0;
            foreach($stats['nom_categorie'] as $key => $value) {
                if($compteurCategorie == $verif) {
                    $categorie = $key;
                }
                $verif++;
            }
            $articleConseilles = recupArticle($taille, $categorie, $couleur);
            for ($i=0; $i < count($articleConseilles) ; $i++) { 
                if(!in_array($articleConseilles[$i]['id'], $id)) {
                    $nombreArticle++;
                    array_push($listeArticleConseilles, $articleConseilles[$i]);
                }
            }
            $compteurCouleur++;
            if($compteurCouleur == 4) {
                $compteurTaille++;
                $compteurCouleur = 0;
            }
            if($compteurTaille == 4) {
                $compteurTaille = 0;
                $compteurCategorie++;
            }
            if($compteurCategorie == 4) {
            break;
        }
    }
    $descriptif = '<div class="desc" ><h1>Les produits conseillés </h1></div>';
    $articleCategorie = $articleCategorie.'<div id = "contentFlexIP">';
    for ($i=0; $i < 5 ; $i++) { 
        if(!empty($listeArticleConseilles)) {
            $articleCategorie = $articleCategorie.'
            <div class="articles">
            <a href="Controleur/voir_articles.php?code='.$listeArticleConseilles[$i]['id'].'"><img id="photo" src="'.$listeArticleConseilles[$i]['photo1'].'"></a>
            <div class="infos">
            <span id="categorie">'.$listeArticleConseilles[$i]['marque'].'</span>
            <span id="prix">'.$listeArticleConseilles[$i]['prix'].'€</span>
            </div>
            </div>';
        }
    }
    $articleCategorie = $articleCategorie.'</div>';
} else {
    $descriptif = '<div class="desc">Ajoutez plus de produits a vos favoris pour avoir accès aux articles conseillés!</div>';
}
}
include("./Vue/accueil.php");
?>

