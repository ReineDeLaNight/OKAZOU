<?php 
require("../Modele/voir_membres.php");
$listeMembres = afficherMembres();
$listeMembre = '';
for ($i=0; $i < count($listeMembres); $i++) { 
    $listeMembre = $listeMembre.'<div>
    <a href="modifier_membres.php?id='.$listeMembres[$i]['id'].'">'.$listeMembres[$i]['pseudo'].'</a>
    <a href="voir_membres.php?supprimer='.$listeMembres[$i]['id'].'">Supprimer</a>
    </div>';
}
if(!empty($_GET['supprimer'])) {
    supprimerMembres($_GET['supprimer']);
}
require("../Vue/voir_membres.php");
?>