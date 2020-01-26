<?php
function afficherMembre() {
    $id = $_GET['id'];
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
    $req = $bdd -> prepare("SELECT * FROM membre M LEFT JOIN ville V ON M.ville = V.id WHERE M.id LIKE :id");
    $req -> bindParam(':id', $id, PDO::PARAM_INT);
    $req -> execute();
    $listeMembres = $req -> fetch();
    return $listeMembres;
}
function modifierMembre($pseudo,$mdp,$sexe,$ville,$dateN,$id) {
    $ville = strtolower($ville);
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
    $req1 = $bdd -> prepare("SELECT id FROM ville WHERE nom LIKE :ville");
    $req1 -> bindParam(':ville', $ville, PDO::PARAM_STR);
    $req1 -> execute();
    $ville = $req1 -> fetch();
    $ville = $ville[0];

    $req = $bdd -> prepare("UPDATE  membre  SET  pseudo = :pseudo, mdp = :mdp, date_naissance = :dateN, sexe = :sexe, ville = :ville
    WHERE id LIKE :id");
    $req -> bindParam(':id', $id, PDO::PARAM_INT);
    $req -> bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $req -> bindParam(':mdp', $mdp, PDO::PARAM_STR);
    $req -> bindParam(':dateN', $dateN, PDO::PARAM_STR);
    $req -> bindParam(':sexe', $sexe, PDO::PARAM_STR);
    $req -> bindParam(':ville', $ville, PDO::PARAM_INT);
    $req -> execute();
}
?>