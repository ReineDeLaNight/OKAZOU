<?php 
?>
<!DOCTYPE html>

<html>

  <head>
    <title>ARTICLE</title>
    <script type='text/javascript' src="https://code.jquery.com/jquery-3.4.1.min.js"> </script>
    <script> </script>
  </head>

  <body>
    <div>
         <h1><?php echo($infoArticle[1]);?></h1>
         <img src="../Images/<?php echo($infoArticle[6]);?>">
         <div><?php echo($infoArticle[9]); ?></div>
         <div><?php echo($infoArticle[2]); ?>€</div>
         <div><?php echo($infoArticle[4]); ?></div>
         <div><?php echo($infoArticle[5]); ?></div>
         <div><?php echo($infoArticle[12]); ?></div>
         <div>Vu sur <a href="<?php echo($infoArticle[13]); ?>"> <img src="https://www.bing.com/th/id/OIP.Pc-LAnO4uE3WYI0f3AIIUQHaC2?w=300&h=115&c=7&o=5&dpr=1.13&pid=1.7"></div> </a>
         <form action="../Controleur/voir_articles.php" method = "get">
         <input type="hidden" name=code value=<?php echo($_GET["code"]);?>>
         <input type="submit" name=favori value="<?php echo($favori);?>">
         </form>
         <form action="../accueil.php">
          <button type="submit"> Retour à l'accueil </button>
         </form>

  </body>

</html>