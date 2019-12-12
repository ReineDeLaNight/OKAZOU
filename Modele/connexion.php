<?php
    function testConnexion($pseudo, $mdp) {
        $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
    
        $identifiants = $bdd->prepare("SELECT id, pseudo, mdp FROM membre WHERE pseudo LIKE :pseudo AND mdp LIKE :mdp");
        $identifiants->bindParam(':pseudo',$pseudo,PDO::PARAM_STR);
        $identifiants->bindParam(':mdp',$mdp,PDO::PARAM_STR);
        $identifiants->execute();
        
        
        if ($ligne = $identifiants->fetch()) {
            echo($ligne[0]);
            $_SESSION['id'] = $ligne[0];
            $connexion = true;
            
        } else {
            $connexion = false;
        }

        return $connexion;
        
    }
    
    function get_role() {
        echo $_GET['pseudo'];
        $bdd = new PDO("mysql:host=localhost;dbname=okazou","root","");
        $req = $bdd->prepare("SELECT role FROM membre WHERE pseudo LIKE :pseudo");
        $req->bindParam(':pseudo', $_GET['pseudo'], PDO::PARAM_STR);
        $req->execute();
        $role = $req->fetch();
        return $role[0];
    }
?>

