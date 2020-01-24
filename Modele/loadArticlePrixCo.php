<?php
$articleCount = $_POST['articleNewCount'];
$categorie = $_POST['categorie'];
$souscategorie = $_POST['souscategorie'];
$min = $_POST['min'];
$max = $_POST['max'];
$pere = $_POST['pere'];
$membre = $_POST['membre'];
$flag = 'f';

$bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
$req1 = $bdd -> prepare("SELECT pere FROM categorie WHERE nom_categorie LIKE :categorie");
$req1 -> bindParam(':categorie',$categorie,PDO::PARAM_STR);
$req1 -> execute();
$pere = $req1 -> fetch();
$pere = $pere[0];

$req2 = $bdd -> prepare("SELECT * FROM article A
INNER JOIN categorie AS C ON A.categorie = C.id
INNER JOIN marque AS M ON A.marque = M.id
WHERE C.nom_categorie LIKE :sousCategorie AND C.pere LIKE :idPere AND A.prix >= :min AND A.prix <= :max ORDER BY A.prix ");
$req2 -> bindParam(':sousCategorie',$souscategorie,PDO::PARAM_STR);
$req2 -> bindParam(':idPere',$pere,PDO::PARAM_INT);
$req2 -> bindParam(':min',$min,PDO::PARAM_INT);
$req2 -> bindParam(':max',$max,PDO::PARAM_INT);
$req2 -> execute();
$j=0;
for($i=0; $i < $articleCount; $i++) {
    $listeArticle = $req2 -> fetch();
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
        <a href="Controleur/voir_articles.php?code='.$listeArticle['id'].'"><img id="photo" src="'.$listeArticle['photo1'].'"></a>
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