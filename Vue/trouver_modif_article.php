<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OKAZOU</title>
</head>
<body>
    <?php echo $msgErreur; ?>
    <form action="./trouver_modif_article.php" method="get">
        <p>Entrer le nom exact de l'article à modifier:   <input type="text" name="nom_article"/>
        <button type="submit">Confirmer</button>
    </form>
</body>
</html>