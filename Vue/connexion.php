<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>
    <?php echo $erreurAff; ?>
    <form action="./connexion.php" method="GET">
        <p>Pseudo<input type="text" name="pseudo"></p>
        <p>Mot de passe<input type="text" name="mdp"></p>
        <input type="hidden" name="premiereConnexion" value="false">
        <p><button type="submit">Confirmer</button></p>
    </form>
</body>
</html>