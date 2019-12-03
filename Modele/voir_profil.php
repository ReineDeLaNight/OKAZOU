<?php
    function afficherProfil() {
        $bdd = new PDO("mysql:host=localhost;dbname=okazou","root","");
        $req = $bdd -> prepare("SELECT * FROM membre");
        $req -> execute();
        $infoProfil = $req -> fetch();
        print_r($infoProfil);
    }
?>