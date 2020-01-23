<?php
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link href="../CSS/accueil.css" rel="stylesheet">
    <title>Favoris</title>
</head>
<body>
    <h1>OKAZOU</h1>
    <h1>Articles Favoris :</h1>
   <div id="contentFlexIPO"> <?php echo($article) ?> </div>
    <form action="../accueil.php">
      <button type="submit"> Retour à l'accueil </button>
    </form>
</body>
</html>