<?php
session_start();
$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$_SESSION['url'] = $monUrl;

include("./Modele/accueil.php");
if (!isset($_SESSION['etatConnexion'])) {  // Si l'utilisateur n'est pas connecté
    $_SESSION['etatConnexion'] = false;
    $boutonUtilisateur = 
    '<a href="./Controleur/connexion.php"> Connexion </a>
    <a href="./Controleur/inscription.php"> Inscription </a>';
} else if ($_SESSION['etatConnexion'] == true && $_SESSION['role'] == 'a') { // Si l'utilisateur est admin
    $boutonUtilisateur = 
    '<a href="./Controleur/connexion.php"> Connexion </a>
    <a href="./Controleur/deconnexion.php"> Déconnexion </a>
    <a href="./Vue/action_admin.php">Page de contrôle admin</a>
    <a href="./Controleur/voir_prod_consult.php"> Historique </a>
    <a href="./Controleur/voir_favoris.php"> Favoris </a>';
} else if ($_SESSION['etatConnexion'] == true) { // Si l'utilisateur est connecté
    $boutonUtilisateur = 
    '<form action="./Controleur/voir_profil.php">
    <button id="boutonPage" type="submit">Voir le profil</button>
    </form>
    <form action="./Controleur/deconnexion.php">
    <button id="boutonPage" type="submit">Se déconnecter</button>
    </form>
    <form action="./Controleur/voir_prod_consult.php">
    <button id="boutonPage" type="submit">Historique</button>
    </form>
    <form action="./Controleur/voir_favoris.php">
    <button id="boutonPage" type="submit">Favoris</button>
    </form>';
} else { // A voir ce que ça fait là
    $_SESSION['etatConnexion'] = false;
    $boutonUtilisateur = 
    '<a href="./Controleur/connexion.php">Connexion</a>
    <a href="./Controleur/inscription.php">Inscription</a>';
}
// récuperer une liste d'articles a afficher
$listeArticle = listeArticle();
for($i=0; $i<sizeof($listeArticle) ;$i++)
{
    $nomBouton[$i] = '';
    if(isset($_SESSION['id'])) {
        //$nomBouton[$i] = afficherFavori($listeArticle[$i][0]);
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

for ($i = 0; $i < sizeof($categorie); $i++) {
    for($j = 1; $j<sizeof($categorie[$i]);$j++) {
        if ($categorie[$i][$j][0] == 'femmes' || $categorie[$i][$j][0] == 'hommes' || $categorie[$i][$j][0] == 'enfants') {
            unset($categorie[$i][$j]);
        }
    }
}

$categorie[0] = array_values($categorie[0]);
$categorie[1] = array_values($categorie[1]);
$categorie[2] = array_values($categorie[2]);

for($i=0; $i < sizeof($categorie);$i++)
{
    for($j = 0; $j < sizeof($categorie[$i]); $j++) {
        if ($categorie[$i][0][1] == 1) {
            $catprin = 'femmes';
        } else if ($categorie[$i][0][1] == 2) {
            $catprin = 'hommes';
        } else {
            $catprin = 'enfants';
        }
        $cat[$i] = $cat[$i].'<a href ="./accueil.php?pere='.$categorie[$i][0][1].'&categorie='.$catprin.'&souscategorie='.$categorie[$i][$j][0].'">'.$categorie[$i][$j][0].'</a>';
    }
}
// barre de recherche

// tri prix

$tri_prix = "";
$recherche = "";

if (!empty($_GET['categorie']) && !empty($_GET['souscategorie'])) {
    
    $tri_prix = '<form href="./accueil.php">
    Prix min:&nbsp;
    <input type="number" name="min"></input>&nbsp;max:&nbsp;
    <input type="number" name="max"></input>
    <input type="hidden" name="categorie" value="'.$_GET['categorie'].'"></input>
    <input type="hidden" name="souscategorie" value="'.$_GET['souscategorie'].'"></input>
    <input type="hidden" name="pere" value="'.$_GET['pere'].'"></input>
    <input type="submit" value="Ok">
    </form>';
}




// Recupérer les articles selon la catégorie choisie
$filtre = "";

$articleCategorie = '';
$descriptif = '';
if(!empty($_GET['categorie']) && !empty($_GET['souscategorie']) && empty($_GET['filtre']) && empty($_GET['min'])) {
    
    $listeMarque = liste_marque($_GET['categorie'], $_GET['souscategorie']);

    $filtre .= '
    <div class="dropdown">
    <label class="dropbtn">Marque</label>
    <div class="dropdown-content">';

    for ($i = 0; $i < sizeof($listeMarque); $i++) {
        $filtre .= '<a href="accueil.php?filtre=go&marque='.$listeMarque[$i][0].'&pere='.$_GET['pere'].'&categorie='.$_GET['categorie'].'&souscategorie='.$_GET['souscategorie'].'">'.$listeMarque[$i][0].'</a>';
    }
    $filtre .= '
    </div>
    </div>';

    

    $listeArticleCategorie = articleCategorie($_GET['categorie'],$_GET['souscategorie']);
    $descriptif = '<div class="desc"><h1>'.$_GET['souscategorie'].' pour '.$_GET['categorie'].'</h1></div>';
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
    $recherche .= '
    <div id="cover">
      <form method="get" action="">
        <div class="tb">
         <input class="recherche" name ="recherche" type="text" placeholder="Cherchez un article" required>
            <button id="chercher" type="submit"> GO</button>
          </div>
        </div>
      </form>
    </div>';
} else if(!empty($_GET['categorie']) && !empty($_GET['souscategorie']) && !empty($_GET['filtre'])) {
    
    $listeMarque = liste_marque($_GET['categorie'], $_GET['souscategorie']);

    $filtre .= '<div>
    <div class="dropdown">
    <label class="dropbtn">Marque</label>
    <div class="dropdown-content">';

    for ($i = 0; $i < sizeof($listeMarque); $i++) {
        $filtre .= '<a href="accueil.php?filtre=go&marque='.$listeMarque[$i][0].'&categorie='.$_GET['categorie'].'&souscategorie='.$_GET['souscategorie'].'&pere='.$_GET['pere'].'">'.$listeMarque[$i][0].'</a>';
    }
    $filtre .= '
    </div>
    </div>
    </div>';

    

    $listeArticleCategorie = article_marque_categorie($_GET['categorie'],$_GET['souscategorie'],$_GET['marque']);
    $descriptif = '<div class="desc" ><h1>'.$_GET['souscategorie'].' pour '.$_GET['categorie'].'</h1></div>';
    $articleCategorie = $articleCategorie.'<div id = "contentFlexIP">';
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
    $recherche .= '
    <div id="cover">
      <form method="get" action="">
        <div class="tb">
         <input class="recherche" name ="recherche" type="text" placeholder="Cherchez un article" required>
            <button id="chercher" type="submit"> GO</button>
          </div>
        </div>
      </form>
    </div>';
    
} else if (!empty($_GET['recherche']) && empty($_GET['categorie'])) {

    $recherche .= '<form href="./accueil.php?">
    
    <input type="text" class="recherche" placeholder="Cherchez un article.." name="recherche">
    <input type="submit" value="Go !">
    </form>';

    $listeArticleCategorie = article_recherche($_GET['recherche']);
    $descriptif = '<div class="desc" ><h1>Résultats de la recherche: '.$_GET['recherche'].'</h1></div>';
    $articleCategorie = $articleCategorie.'<div id = "contentFlexIP">';
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
// Récupérer les produits conseillés si le mec est connecté et que la categorie n'a pas été choisie
/*if (!empty($_GET['min']) && !empty($_GET['max']) && empty($_GET['categorie']) && empty($_GET['recherche'])) {
    
    $listeArticleCategorie = article_prix($_GET['min'],$_GET['max']);
    $descriptif = '<div class="desc" ><h1>Articles triés par prix</h1></div>';
    $articleCategorie = $articleCategorie.'<div id = "contentFlexIP">';
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
} */
if (!empty($_GET['min']) && !empty($_GET['max']) && !empty($_GET['categorie']) && empty($_GET['recherche'])) {
    
    $listeArticleCategorie = article_prix_cat($_GET['min'],$_GET['max'],$_GET['categorie'], $_GET['souscategorie']);
    $descriptif = '<div class="desc" ><h1>Articles triés par prix</h1></div>';
    $articleCategorie = $articleCategorie.'<div id = "contentFlexIP">';
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
    $recherche .= '
    <div id="cover">
      <form method="get" action="">
        <div class="tb">
         <input class="recherche" name ="recherche" type="text" placeholder="Cherchez un article" required>
            <button id="chercher" type="submit"> GO</button>
          </div>
        </div>
      </form>
    </div>';
} else if(empty($_GET['categorie']) && $_SESSION['etatConnexion'] == true && empty($_GET['min']) && empty($_GET['recherche'])) {
    $nombreFavoris = nombreFavoris();

    $recherche .= '<div id="cover">
    <form method="get" action="">
      <div class="tb">
       <input class="recherche" name ="recherche" type="text" placeholder="Cherchez un article" required>
          <button id="chercher" type="submit"> GO</button>
        </div>
      </div>
    </form>
  </div>';

    

    if($nombreFavoris > 5) {
        $infoHisto = testAlgo($_SESSION['id']);
        for($i = 0; $i <sizeof($infoHisto); $i++){
            $id[$i] = $infoHisto[$i]['id'];
            $couleur[$i] = $infoHisto[$i]['couleur'];
            $nom_categorie[$i] = $infoHisto[$i]['nom_categorie'];
        }
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
        array_multisort($stats['nom_categorie'],SORT_DESC);
        
        
        $tailleTab = count($stats['couleur']);
        for($i=0; $i < $tailleTab - 4 ; $i++) { 
            array_pop($stats['couleur']);
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
        while($nombreArticle < 50) {
            $verif = 0;
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
            $articleConseilles = recupArticle($categorie, $couleur);
            for ($i=0; $i < count($articleConseilles) ; $i++) { 
                if(!in_array($articleConseilles[$i]['id'], $id)) {
                    $nombreArticle++;
                    array_push($listeArticleConseilles, $articleConseilles[$i]);
                }
            }
            $compteurCouleur++;
            if($compteurCouleur == 4) {
                $compteurCategorie++;
                $compteurCouleur = 0;
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
} else if (empty($_GET['recherche'])) {
    $descriptif = '<div class="desc">Ajoutez plus de produits a vos favoris pour avoir accès aux articles conseillés!</div>';
}


}
if (empty($_GET['categorie']) && $_SESSION['etatConnexion'] == false && empty($_GET['recherche']) ) {
    $recherche .= '
    <div id="cover">
      <form method="get" action="">
        <div class="tb">
         <input class="recherche" name ="recherche" type="text" placeholder="Cherchez un article" required>
            <button id="chercher" type="submit"> GO</button>
          </div>
        </div>
      </form>
    </div>';
}


include("./Vue/accueil.php");
?>