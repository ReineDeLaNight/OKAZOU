<?php
    function supprimer_compte($pseudo) {
        $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', ''); 
        $req = $bdd->prepare("DELETE FROM membre WHERE pseudo LIKE :pseudo");
        $req -> bindParam(':pseudo',$pseudo,PDO::PARAM_STR);
        $req->execute();
    }
?>