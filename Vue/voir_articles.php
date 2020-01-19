<?php 
?>
<!DOCTYPE html>

<html>

  <head>
    <title>ARTICLE</title>
    <link href="../CSS/accueil.css" rel="stylesheet">
    <script type='text/javascript' src="https://code.jquery.com/jquery-3.4.1.min.js"> </script>
    <script> </script>
  </head>

  <body>
    <div>
         <h1><?php echo($infoArticle[1]);?></h1>
         <img src="<?php echo($infoArticle[7]);?>">
         <div><?php echo($infoArticle[10]); ?></div>
         <div><?php echo($infoArticle[3]); ?>€</div>
         <div><?php echo($infoArticle[5]); ?></div>
         <div><?php echo($infoArticle[6]); ?></div>
         <div><?php echo($infoArticle[13]); ?></div>
         <div>Vu sur <a href="<?php echo($infoArticle[2]); ?>"> <img class="logo" src="<?php echo($infoArticle[14]); ?>"></div> </a>
         <?php if(isset($_SESSION['id'])) {
           echo('<form action="../Controleur/voir_articles.php" method = "get">
           <input type="hidden" name=code value="'.$_GET["code"].'">
           <input type="submit" name=favori value="'.$favori.'">
           </form>');
           }?>
         
         <form action="../accueil.php">
          <button type="submit"> Retour à l'accueil </button>
         </form>

  </body>

</html>