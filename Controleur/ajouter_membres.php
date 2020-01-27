<?php 
require("../Modele/ajouter_membres.php");
if(!empty($_GET['ajout'])) {
    ajouterMembre();
    echo('Membre ajouté');
}
require("../Vue/ajouter_membres.php");
?>