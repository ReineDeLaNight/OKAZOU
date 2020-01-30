<?php
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link href="../CSS/accueils.css" rel="stylesheet">
    <title>Historique</title>
</head>
<body>
    <h1>OKAZOU</h1>
    <h1>Articles consultés :</h1>
   <div id="contentFlexIP"> <?php echo($article); ?> </div>
    <form action="./voir_prod_consult.php">
      <button type="submit" name="historique" value="supprimer"> Supprimer l'historique </button>
    </form>
    <form action="../accueil.php">
      <button type="submit"> Retour à l'accueil </button>
    </form>
</body>
</html>