<?php
    function aff_article($id) {
        $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
    
        $req = $bdd->prepare("SELECT DISTINCT A.id, A.nom, A.description, A.prix, A.lien, A.couleur, A.etat, A.photo1, A.photo2, A.photo3, T.taille, C.nom_categorie, S.nom, M.marque 
        FROM article AS A 
        INNER JOIN taille  AS T ON A.taille = T.id
        INNER JOIN categorie AS C ON A.categorie = C.id
        INNER JOIN site AS S ON A.site = S.id
        INNER JOIN marque AS M ON A.marque = M.id
        WHERE A.id = :id");

        $req -> bindParam(':id',$id,PDO::PARAM_STR);
        $req->execute() or die(print_r($req->errorInfo(), TRUE));

        return $req->fetch();
    }

    function modif_article($id, $nom, $description, $prix, $lien, $couleur, $etat, $photo1, $photo2, $photo3, $taille, $categorie, $site, $marque) {
        $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');

        $req = $bdd->prepare("UPDATE article SET nom = :nom, description = :description, prix = :prix, lien = :lien, couleur = :couleur, etat = :etat, photo1 = :photo1, photo2 = :photo2, photo3 = :photo3, taille = :taille, categorie = :categorie, site = :site, marque = :marque
        WHERE id = :id");

        $req -> bindParam(':id',$id,PDO::PARAM_INT);
        $req -> bindParam(':nom',$nom,PDO::PARAM_STR);
        $req -> bindParam(':description',$description,PDO::PARAM_STR);
        $req -> bindParam(':prix',$prix,PDO::PARAM_INT);
        $req -> bindParam(':lien',$lien,PDO::PARAM_STR);
        $req -> bindParam(':couleur',$couleur,PDO::PARAM_STR);
        $req -> bindParam(':etat',$etat,PDO::PARAM_STR);
        $req -> bindParam(':photo1',$photo1,PDO::PARAM_STR);
        $req -> bindParam(':photo2',$photo2,PDO::PARAM_STR);
        $req -> bindParam(':photo3',$photo3,PDO::PARAM_STR);
        $req -> bindParam(':taille',$taille,PDO::PARAM_STR);
        $req -> bindParam(':categorie',$categorie,PDO::PARAM_STR);
        $req -> bindParam(':site',$site,PDO::PARAM_STR);
        $req -> bindParam(':marque',$marque,PDO::PARAM_STR);

        $req->execute() or die(print_r($req->errorInfo(), TRUE));
    }

?>
