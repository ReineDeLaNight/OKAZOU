<?php
    function testConnexion($pseudo, $mdp) {
        $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
    
        $identifiants = $bdd->prepare("SELECT id, pseudo, mdp FROM membre WHERE pseudo LIKE :pseudo AND mdp LIKE :mdp");
        $identifiants->bindParam(':pseudo',$pseudo,PDO::PARAM_STR);
        $identifiants->bindParam(':mdp',$mdp,PDO::PARAM_STR);
        $identifiants->execute();
        
        
        if ($ligne = $identifiants->fetch()) {
<<<<<<< HEAD
=======
            echo($ligne[0]);
            $_SESSION['id'] = $ligne[0];
>>>>>>> f6f81b18cd1930ac65b8f35e820af71cb59d8447
            $connexion = true;
            
        } else {
            $connexion = false;
        }

        return $connexion;
        
    }
?>

