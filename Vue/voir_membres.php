<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OKAZOU</title>
</head>
<body>
<h1>Liste des membres : </h1>
    <?php echo($listeMembre); ?>
    <form action="../Controleur/ajouter_membres.php">
        <button type="submit">Ajouter un membre</button>
    </form>
    <form action="../Vue/action_admin.php">
        <button type="submit">Page de contrôle Admin</button>
    </form>
</body>
</html>