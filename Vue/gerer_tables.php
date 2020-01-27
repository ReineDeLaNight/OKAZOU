<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OKAZOU</title>
</head>
<body>
    <h1>Gestion des tables</h1>
    <?php if(empty($_GET['table'])){
        echo('
        <div><a href="gerer_tables.php?table=categorie">Catégories</a></div>
        <div><a href="gerer_tables.php?table=marque">Marque</a></div>
        <div><a href="gerer_tables.php?table=site">Site</a></div>
        <div><a href="gerer_tables.php?table=taille">Taille</a></div>
        <div><a href="gerer_tables.php?table=Ville">Ville</a></div>
        ');
        } echo($categorie);
        echo($marque);
        echo($site);
        echo($taille);
        echo($ville);?>
    <form action="../Vue/action_admin.php">
        <button type="submit">Page de controle admin</button>
    </form>
</body>
</html>