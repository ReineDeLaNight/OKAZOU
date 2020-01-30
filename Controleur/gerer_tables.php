<?php 
require("../Modele/gerer_tables.php");
$taille ='';
$categorie ='';
$ville ='';
$marque ='';
$site ='';
if(!empty($_GET['table'])) {
if($_GET['table'] == 'site' && empty($_GET['supprimer'])) {
    $listeSites = afficherSite();
    $site = '';
    $site .= '<div>Cliquer sur "S" pour supprimer le site</div><br>';
    for ($i=0; $i < count($listeSites); $i++) { 
        $site = $site.'<div>
        <a href="./gerer_tables.php?table=site&name='.$listeSites[$i]['nom'].'">'.$listeSites[$i]['nom'].'</a>
        &nbsp;&nbsp;&nbsp;&nbsp;<a href="gerer_tables.php?supprimer='.$listeSites[$i]['nom'].'&table='.$_GET['table'].'">S</a>
        </div>';
    }
    $site .= '<a href="gerer_tables.php?table=site&ajouter=ok">Ajouter un site</a>
    <br><a href="gerer_tables.php?">Retour</a>';
} else if ($_GET['table'] == 'site' && !empty($_GET['supprimer'])) {
    sup_site($_GET['supprimer']);
    header("Location:./gerer_tables.php?table=site");
}
if($_GET['table'] == 'site' && !empty($_GET['ajouter'])) {
    $site = '<form action="../Controleur/gerer_tables.php">
    <label>Nom du site : <input type="text" name="nom"></label>
    <label>Lien : <input type="text" name="lien"></label>
    <label>Logo : <input type="text" name="logo"></label>
    <input type="hidden" name="table" value="site">
    <input type="submit" value="Go" name="add"><label>
</form>';
}
if($_GET['table'] == 'site' && !empty($_GET['add'])) {
    ajouterSite();
    header("Location:./gerer_tables.php?table=site");
}
if($_GET['table'] == 'site' && !empty($_GET['name'])) {
    $infos = afficherInfoSite($_GET['name']);
    $site = '<h1>Infos du site</h1>
    Nom : '.$infos['nom'].'<br>
    Logo : <img src ="'.$infos['logo'].'"><br>
    Lien : '.$infos['lien'].'<br>
    <a href="gerer_tables.php?table=site">Retour</a>
    ';
}
if($_GET['table'] == 'marque' && empty($_GET['supprimer'])) {
    $listeMarques = afficherMarque();
    $marque = '';
    $marque .= '<div>Cliquer sur "S" pour supprimer la marque</div><br>';
    for ($i=0; $i < count($listeMarques); $i++) { 
        $marque = $marque.'<div>
        '.$listeMarques[$i]['marque'].'&nbsp;&nbsp;&nbsp;&nbsp;<a href="gerer_tables.php?supprimer='.$listeMarques[$i]['marque'].'&table='.$_GET['table'].'">S</a></div>';
    }
    $marque .= '<a href="gerer_tables.php?table=marque&ajouter=ok">Ajouter une marque </a>
    <br><a href="gerer_tables.php?">Retour</a>';
} else if ($_GET['table'] == 'marque' && !empty($_GET['supprimer'])) {
    sup_marque($_GET['supprimer']);
    header("Location:./gerer_tables.php?table=site");
}
if($_GET['table'] == 'marque' && !empty($_GET['ajouter'])) {
    $marque = '<form action="../Controleur/gerer_tables.php">
    <label>Nom du marque : <input type="text" name="marque"></label>
    <input type="hidden" name="table" value="marque">
    <input type="submit" value="Go" name="add"><label>
</form>';
}
if($_GET['table'] == 'marque' && !empty($_GET['add'])) {
    ajouterMarque();
    header("Location:./gerer_tables.php?table=marque");
}
if($_GET['table'] == 'categorie' && empty($_GET['supprimer'])) {
    $listeCategories = afficherCategorie();
    $categorie = '';
    $categorie .= '<div>Cliquer sur "S" pour supprimer la catégorie</div><br>';
    for ($i=0; $i < count($listeCategories); $i++) { 
        $categorie = $categorie.'<div>
        '.$listeCategories[$i]['nom_categorie'].'&nbsp;&nbsp;&nbsp;&nbsp;<a href="gerer_tables.php?supprimer='.$listeCategories[$i]['nom_categorie'].'&table='.$_GET['table'].'">S</a>
        </div>';
    }
    $categorie .= '<a href="gerer_tables.php?table=categorie&ajouter=ok">Ajouter une categorie </a>
    <br><a href="gerer_tables.php?">Retour</a>';
} else if ($_GET['table'] == 'categorie' && !empty($_GET['supprimer'])) {
    sup_categorie($_GET['supprimer']);
    header("Location:./gerer_tables.php?table=categorie");
}
if($_GET['table'] == 'categorie' && !empty($_GET['ajouter'])) {
    $categorie = '<form action="../Controleur/gerer_tables.php">
    <label>Nom du categorie : <input type="text" name="categorie"></label>
    <input type="hidden" name="table" value="categorie">
    <select name="pere">
        <option value="1" >Femmes</option>
        <option value="2" >Hommes</option>
        <option value="3" >Enfants</option>
    </select>
    <input type="submit" value="Go" name="add"><label>
</form>';
}
if($_GET['table'] == 'categorie' && !empty($_GET['add'])) {
    ajouterCategorie();
    header("Location:./gerer_tables.php?table=categorie");
}
if($_GET['table'] == 'taille' && empty($_GET['supprimer'])) {
    $listeTailles = afficherTaille();
    $taille = '';
    for ($i=0; $i < count($listeTailles); $i++) { 
        $taille = $taille.'<div>
        '.$listeTailles[$i]['taille'].'&nbsp;&nbsp;&nbsp;&nbsp;<a href="gerer_tables.php?supprimer='.$listeTailles[$i]['taille'].'&table='.$_GET['table'].'">S</a>
        </div>';
    }
    $taille .= '<a href="gerer_tables.php?table=taille&ajouter=ok">Ajouter une taille </a>
    <br><a href="gerer_tables.php?">Retour</a>';
} else if ($_GET['table'] == 'taille' && !empty($_GET['supprimer'])) {
    sup_taille($_GET['supprimer']);
    header("Location:./gerer_tables.php?table=taille");
}
if($_GET['table'] == 'taille' && !empty($_GET['ajouter'])) {
    $listeCategories = afficherCategorie();
    $infosCategorie = '';
    for ($i=0; $i < count($listeCategories); $i++) { 
        $infosCategorie = $infosCategorie.
       '<option value="'.$listeCategories[$i]['nom_categorie'].'" >'.$listeCategories[$i]['nom_categorie'].'</option>'
        ;
    }

    $taille = '<form action="../Controleur/gerer_tables.php">
    <label>Nom du taille : <input type="text" name="taille"></label>
    <input type="hidden" name="table" value="taille">
    <label> Catégorie associée</label> <select name="categorie">'.$infosCategorie.'</select>
    <input type="submit" value="Go" name="add"><label>
</form>';
}
if($_GET['table'] == 'taille' && !empty($_GET['add'])) {
    ajouterTaille();
   // header("Location:./gerer_tables.php?table=taille");
}

}
require("../Vue/gerer_tables.php");
?>