<?php
    function trouver_article($nom_article) { // Il faudra rajouter l'attribut titre car on considère ici que le nom de l'article est la description
        $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');

        $req = $bdd->prepare("SELECT id FROM article WHERE description LIKE :nom_article") or die(print_r($req->errorInfo(), TRUE));
        $req->bindParam(':nom_article', $nom_article, PDO::PARAM_STR) or die(print_r($req->errorInfo(), TRUE));
        $req->execute() or die(print_r($req->errorInfo(), TRUE));

        if ($ligne = $req->fetch()) {
            $id = $ligne[0];
        } else {
            $id = false;
        }

        return $id;
    }
?>