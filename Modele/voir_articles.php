<?php 
function afficherArticles() {
    $codeArticle = $_GET['code'];
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', ''); 
    $req = $bdd -> prepare("SELECT A.id, A.description, A.prix, A.keyword, A.couleur, A.etat, A.photo1, A.photo2, A.photo3, T.taille, T.categorie, C.nom_categorie, S.nom, S.lien, M.marque FROM article A
    INNER JOIN taille T on A.taille = T.id
    INNER JOIN categorie AS C ON A.categorie = C.id
    INNER JOIN site S ON A.site = S.id
    INNER JOIN marque M ON A.marque = M.id WHERE A.id LIKE :codeArticle");
    
    $req -> bindParam(':codeArticle', $codeArticle, PDO::PARAM_INT);
    $req -> execute();
    $infoArticle = $req -> fetch();
    return $infoArticle;
}

function ajouterFavori() {
    $codeArticle = $_GET['code'];
    $dateFav = date("Y-m-d");
    $membre = $_SESSION['id'];
    $flag = 'f';
    
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', ''); 
    $req1 = $bdd -> prepare("SELECT COUNT(id) FROM favori WHERE article LIKE :codeArticle AND membre LIKE :membre");
    $req1 -> bindParam(':codeArticle', $codeArticle, PDO::PARAM_INT);
    $req1 -> bindParam(':membre', $membre, PDO::PARAM_INT);
    $req1 -> execute(); 
    $test = $req1 -> fetch();
    echo($test[0]);
    if($test[0]==0) {
        if(!empty($_GET['favori'])) {
            $req = $bdd -> prepare("INSERT INTO favori(date_favori, flag, article, membre) VALUES (:dateFav, :flag, :codeArticle, :membre)");
            $req -> bindParam(':dateFav', $dateFav, PDO::PARAM_STR);
            $req -> bindParam(':flag', $flag, PDO::PARAM_STR);
            $req -> bindParam(':codeArticle', $codeArticle, PDO::PARAM_INT);
            $req -> bindParam(':membre', $membre, PDO::PARAM_INT);
            $req -> execute();
            $nomBouton = 'Supprimer des Favoris';
            return $nomBouton;
        }
        $nomBouton = 'Ajouter aux Favoris';
        return $nomBouton;
        
    } else {
        if(!empty($_GET['favori'])) {
            $req = $bdd -> prepare("DELETE FROM `favori` WHERE article LIKE :codeArticle AND membre LIKE :membre");
            $req -> bindParam(':codeArticle', $codeArticle, PDO::PARAM_INT);
            $req -> bindParam(':membre', $membre, PDO::PARAM_INT);
            $req -> execute();
            $nomBouton = 'Ajouter aux Favoris';
            return $nomBouton;
        }
        $nomBouton = 'Supprimer des Favoris';
        return $nomBouton;
    }
    
}
?>