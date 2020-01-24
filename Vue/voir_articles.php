<?php 
?>
<!DOCTYPE html>

<html>

  <head>
    <title>ARTICLE</title>
    <link href="../CSS/accueil.css" rel="stylesheet">
    <meta charset="UTF-8">
    <script type='text/javascript' src="https://code.jquery.com/jquery-3.4.1.min.js"> </script>
    <script> </script>
  </head>

  <body>
    <div id = "afficheArticle">
      <div id = "englobix">
      <div id ="titre">
         <h1><?php echo($infoArticle['nom']);?></h1>
</div>
<h2> Photo : </h2>
         <div class="photosArticle">
         <a href="<?php echo($infoArticle['lien']); ?>"> <img id="photo"src="<?php echo($infoArticle['photo1']);?>"> </a>
        <?php if(isset($infoArticle['photo2'])) {echo('<a href="'.$infoArticle['lien'].'"><img id="photo"src="'.$infoArticle['photo2'].'"></a>');} ?>
        <?php if(isset($infoArticle['photo3'])) {echo('<a href="'.$infoArticle['lien'].'"><img id="photo"src="'.$infoArticle['photo3'].'"></a>');} ?>          
</div>
         <div>Prix : <?php echo($infoArticle['prix']); ?>€</div>
         <div>Marque : <?php echo($infoArticle['marque']); ?></div>
         <div>Couleur : <?php echo($infoArticle['couleur']); ?></div>
         <div>Categorie : <?php echo($infoArticle['nom_categorie']); ?></div>
         <div>Taille : <?php echo($infoArticle['taille']); ?></div>
         <div>Vu sur <a href="<?php echo($infoArticle['lien']); ?>"> <img class="logo" src="<?php echo($infoArticle[14]); ?>"></div> </a>
         <?php if(isset($_SESSION['id'])) {
           echo('<form action="../Controleur/voir_articles.php" method = "get">
           <input type="hidden" name=code value="'.$_GET["code"].'">
           <input class="favori" type="submit" name=favori value="'.$favori.'">
           </form>');
           }?>
           
    </div>
         <form action="../accueil.php">
          <button type="submit"> Retour à l'accueil </button>
         </form>

  </body>

</html>