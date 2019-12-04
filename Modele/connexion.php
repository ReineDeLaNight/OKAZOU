<?php
    function testConnexion($pseudo, $mdp) {
        $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
    
        $identifiants = $bdd->prepare("SELECT pseudo, mdp FROM membre WHERE pseudo LIKE :pseudo AND mdp LIKE :mdp");
        $identifiants -> bindParam(':pseudo',$pseudo,PDO::PARAM_STR);
        $identifiants -> bindParam(':mdp',$mdp,PDO::PARAM_STR);
        $identifiants->execute();
        
        if ($ligne = $identifiants->fetch()) {
           
            $connexion = true;
       
        } else {
            $connexion = false;
        }

        return $connexion;
        
    }
?>

