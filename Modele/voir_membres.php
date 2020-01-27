<?php 
function afficherMembres() {
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
    $req = $bdd -> prepare("SELECT * FROM membre");
    $req -> execute();
    $listeMembres = $req -> fetchall();
    return $listeMembres;
}
function supprimerMembres($id) {
    $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
    $req = $bdd -> prepare("DELETE FROM membre WHERE id LIKE :id");
    $req -> bindParam(':id', $id, PDO::PARAM_INT);
    $req -> execute();
    $listeMembres = $req -> fetchall();
    return $listeMembres;
}
?>