<?php
$articleCount = $_POST['articleNewCount'];
$categorie = $_POST['categorie'];
$membre = $_POST['membre'];
$flag = 'f';
$bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
$req = $bdd->prepare("SELECT A.id, A.lien, A.description, A.prix, A.keyword, A.couleur, A.etat, A.photo1, A.photo2, A.photo3, T.taille, T.categorie, C.nom_categorie, S.logo, M.marque FROM article A
INNER JOIN taille T on A.taille = T.id
INNER JOIN categorie AS C ON A.categorie = C.id
INNER JOIN site S ON A.site = S.id
INNER JOIN marque M ON A.marque = M.id WHERE C.nom_categorie LIKE :categorie");
$req -> bindParam(':categorie', $categorie, PDO::PARAM_STR);
$req -> execute();
$j = 0;
for($i=0; $i < $articleCount; $i++) {
    $listeArticle = $req -> fetch();
    if(!empty($listeArticle)) {
        $req1 = $bdd -> prepare("SELECT COUNT(id) FROM favori WHERE article LIKE :codeArticle AND membre LIKE :membre AND flag LIKE :flag");
        $req1 -> bindParam(':codeArticle', $listeArticle['id'], PDO::PARAM_INT);
        $req1 -> bindParam(':membre', $membre, PDO::PARAM_INT);
        $req1 -> bindParam(':flag', $flag, PDO::PARAM_STR);
        $req1 -> execute(); 
        $test = $req1 -> fetch();
        if($test[0]==0) {
            $nomBouton = '♡';
        } else {
            $nomBouton = '♥';
        }
        
        if($i == $j)
        {
            echo('<div id ="groupeArticle">');
            $j += 5;
        }        
        echo('<div class="articles">
        <a href="Controleur/voir_articles.php?code='.$listeArticle['id'].'"><img id="photo" src="'.$listeArticle['photo1'].'"></a>
        <div class="infos">
        <span id="categorie">'.$listeArticle['marque'].'</span>
        <span id="couleur">'.$listeArticle['couleur'].'</span>
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