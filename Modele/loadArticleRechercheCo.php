<?php 
$articleCount = $_POST['articleNewCount'];
$recherche = $_POST['recherche'];
$membre = $_POST['membre'];
$flag = 'f';

$bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
$req1 = $bdd->prepare("SELECT * FROM article A INNER JOIN taille T ON T.id = A.taille INNER JOIN categorie C ON C.id = A.categorie INNER JOIN site S ON S.id = A.site INNER JOIN marque M ON M.id = A.marque WHERE locate(:recherche, A.nom) || locate(:recherche, A.description) || locate(:recherche, A.prix) || locate(:recherche, A.couleur) || locate(:recherche, A.etat) || locate(:recherche, T.taille) || locate(:recherche, C.nom_categorie) || locate(:recherche, S.nom) || locate(:recherche, M.marque) LIMIT :nombreArticle");
$req1 -> bindParam(':recherche', $recherche, PDO::PARAM_STR);
$req1 -> bindParam(':nombreArticle', $articleCount, PDO::PARAM_INT);
$req1 -> execute();
$j = 0;
for($i=0; $i < $articleCount; $i++) {
    $listeArticle = $req1 -> fetch();
    $req = $bdd -> prepare("SELECT COUNT(id) FROM favori WHERE article LIKE :codeArticle AND membre LIKE :membre AND flag LIKE :flag");
    $req -> bindParam(':codeArticle', $codeArticle, PDO::PARAM_INT);
    $req -> bindParam(':membre', $membre, PDO::PARAM_INT);
    $req -> bindParam(':flag', $flag, PDO::PARAM_STR);
    $req -> execute(); 
    $test = $req -> fetch();
    if($test[0]==0) {
        $nomBouton = '♡';
        
    } else {
        $nomBouton = '♥';
    }
    if(!empty($listeArticle)) {
        if($i == $j)
        {
            echo('<div id ="groupeArticle">');
            $j += 5;
        }        
        echo('<div class="articles">
        <a href="Controleur/voir_articles.php?code='.$listeArticle[0].'"><img id="photo" src="'.$listeArticle['photo1'].'"></a>
        <div class="infos">
        <span id="categorie">'.$listeArticle['marque'].'</span>
        <span id="prix">'.$listeArticle['prix'].'€</span>
        <span id="favori">'.$nomBouton.'</span>
        
        </div>
        </div>');
        if($i == $j-1)
        {
            echo('</div>');
        }
    }
}
?>