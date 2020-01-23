<?php 
$articleCount = $_POST['articleNewCount'];
$membre = $_POST['membre'];

function testAlgo($id) {
    $flag = 'f';
    $bdd = new PDO("mysql:host=localhost;dbname=okazou;charset=utf8","root","");
    $req = $bdd -> prepare("SELECT A.id, A.couleur, T.taille, C.nom_categorie, M.marque FROM article AS A
    INNER JOIN taille T on A.taille = T.id
    INNER JOIN categorie AS C ON A.categorie = C.id
    INNER JOIN site S ON A.site = S.id
    INNER JOIN marque M on A.marque = M.id
    INNER JOIN favori AS F ON F.article = A.id
    WHERE F.membre = :membre
    AND F.flag = :flag");
    $req -> bindParam(':membre', $id, PDO::PARAM_INT);
    $req -> bindParam(':flag', $flag, PDO::PARAM_STR);
    $req -> execute();
    $result = $req -> fetchall();
    return $result;
}

function recupArticle($taille, $categorie, $couleur) {

    $bdd = new PDO("mysql:host=localhost;dbname=okazou;charset=utf8","root","");
    $req = $bdd -> prepare("SELECT A.id, A.photo1, A.prix, A.couleur, T.taille, C.nom_categorie, M.marque FROM article AS A
    INNER JOIN taille T on A.taille = T.id
    INNER JOIN categorie AS C ON A.categorie = C.id
    INNER JOIN site S ON A.site = S.id
    INNER JOIN marque M on A.marque = M.id
    WHERE T.taille LIKE :taille AND C.nom_categorie LIKE :categorie AND LOCATE( :couleur, couleur)");
    $req ->bindParam(':taille', $taille,  PDO::PARAM_STR);
    $req ->bindParam(':categorie', $categorie,  PDO::PARAM_STR);
    $req ->bindParam(':couleur', $couleur,  PDO::PARAM_STR);
    $req -> execute();
    $result = $req -> fetchall();
    return $result;
}
$infoHisto = testAlgo($membre);
for($i = 0; $i <sizeof($infoHisto); $i++){
    $id[$i] = $infoHisto[$i]['id'];
    $taille[$i] = $infoHisto[$i]['taille'];
    $couleur[$i] = $infoHisto[$i]['couleur'];
    $nom_categorie[$i] = $infoHisto[$i]['nom_categorie'];
}

// print_r($infoHisto);

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
//print_r($stats);

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
//print_r($id);
$compteurTaille = 0;
$compteurCouleur = 0;
$compteurCategorie = 0;
$nombreArticle = 0;
$listeArticleConseilles = [];
while($nombreArticle < 50) {
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
if($articleCount < $nombreArticle) {
$j = 0;
for ($i=0; $i < $articleCount ; $i++) { 
    if($i == $j)
        {
            echo('<div id ="groupeArticle">');
            $j += 5;
        } 
    if(!empty($listeArticleConseilles)) {
        echo ('<div class="articles">
        <a href="Controleur/voir_articles.php?code='.$listeArticleConseilles[$i]['id'].'"><img id="photo" src="'.$listeArticleConseilles[$i]['photo1'].'"></a>
        <div class="infos">
        <span id="categorie">'.$listeArticleConseilles[$i]['marque'].'</span>
        <span id="prix">'.$listeArticleConseilles[$i]['prix'].'€</span>
        </div>
        </div>');
    }
    if($i == $j-1)
        {
            echo('</div>');
        }
}
}
else {
    echo("Ajoutez Plus d'articles a vos favoris!");
}

?>