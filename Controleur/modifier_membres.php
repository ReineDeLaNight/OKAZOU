<?php 
require("../Modele/modifier_membres.php");
$infosMembre = afficherMembre();
$membre ='
<div>Pseudo : '.$infosMembre['pseudo'].'</div>
<div>Mdp : '.$infosMembre['mdp'].'</div>
<div>Sexe : '.$infosMembre['sexe'].'</div>
<div>Ville : '.$infosMembre['nom'].'</div>
<div>Date de Naissance : '.$infosMembre['date_naissance'].'</div>
';
if(!empty($_GET['modif'])) {
    modifierMembre($_GET['pseudo'],$_GET['mdp'],$_GET['sexe'],$_GET['ville'],$_GET['dateNaissance'],$_GET['id']);
}
require("../Vue/modifier_membres.php");
?>