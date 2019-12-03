<?php
    function testConnexion($pseudo, $mdp) {
        $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
        $identifiants = $bdd->prepare("SELECT pseudo, mdp FROM membre WHERE pseudo == ? AND mdp == ?");
        $identifiants->execute(array($pseudo, $mdp));

        $ligne = $identifiants->fetch();
        if ($ligne) {
            $connexion = true;
            $_SESSION["pseudo"] = $pseudo;
            $_SESSION["mdp"] = $mdp;
        } else {
            $connexion = false;
        }
        return $connexion;
    }
?>

