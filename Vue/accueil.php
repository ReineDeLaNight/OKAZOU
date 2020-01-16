<!DOCTYPE html>
<html lang="en">
<head>
    <link href="./CSS/accueil.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>OKAZOU</title>
</head>
<body>
<div> <a href="./accueil.php"><img  class="logo" src ="./Images/logo.png"></a>
     <?php echo $boutonUtilisateur; ?> </div>
    <div class="dropdown">
  <label class="dropbtn">Femmes</label>
  <div class="dropdown-content">
    <?php echo($cat[0]); ?>
  </div>
</div>
<div class="dropdown">
  <label class="dropbtn">Hommes</label>
  <div class="dropdown-content">
    <?php echo($cat[1]); ?>
  </div>
</div>
<div class="dropdown">
  <label class="dropbtn">Enfants</label>
  <div class="dropdown-content">
    <?php echo($cat[2]); ?>
  </div>
</div>
   <div><?php echo($descriptif) ?></div>
   <div> <?php echo($articleCategorie) ?> </div>
    <?php if(empty($_GET['categorie'])) {
    echo('<h1>Quelques articles au hasard :</h1>
    <div>'.$item[rand(0,sizeof($listeArticle)-1)].$item[rand(0,sizeof($listeArticle)-1)].$item[rand(0,sizeof($listeArticle)-1)].$item[rand(0,sizeof($listeArticle)-1)].$item[rand(0,sizeof($listeArticle)-1)].'</div>');} ?>
</body>
</html>