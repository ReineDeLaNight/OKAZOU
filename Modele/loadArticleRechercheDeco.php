<?php 
$articleCount = $_POST['articleNewCount'];
$recherche = $_POST['recherche'];
$bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
$req = $bdd->prepare("SELECT * FROM article A INNER JOIN taille T ON T.id = A.taille INNER JOIN categorie C ON C.id = A.categorie INNER JOIN site S ON S.id = A.site INNER JOIN marque M ON M.id = A.marque WHERE locate(:recherche, A.nom) || locate(:recherche, A.description) || locate(:recherche, A.prix) || locate(:recherche, A.couleur) || locate(:recherche, A.etat) || locate(:recherche, T.taille) || locate(:recherche, C.nom_categorie) || locate(:recherche, S.nom) || locate(:recherche, M.marque) LIMIT :nombreArticle");
$req -> bindParam(':recherche', $recherche, PDO::PARAM_STR);
$req -> bindParam(':nombreArticle', $articleCount, PDO::PARAM_INT);
$req -> execute();
$j = 0;
for($i=0; $i < $articleCount; $i++) {
    $listeArticle = $req -> fetch();
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
        </div>
        </div>');
        if($i == $j-1)
        {
            echo('</div>');
        }
    }
}
?>