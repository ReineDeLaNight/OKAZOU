<!DOCTYPE html>
<html lang="en">
<head>
    <link href="./CSS/accueil.css" rel="stylesheet">
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script> 
        $(document).ready(function() {
            var articleCount = 5;
            var categorie = "<?php echo $_GET['souscategorie']; ?>";
            var membre = "<?php echo $_SESSION['id']; ?>";
            $("#afficherPlusCategorieConnecte").click(function(){
                articleCount = articleCount + 5;
                $("#listeArticle").load("Modele/loadArticleCategorieCo.php", {
                    articleNewCount: articleCount,
                    categorie: categorie,
                    membre : membre
                });
            });
        });
    </script>
    <script> 
        $(document).ready(function() {
            var articleCount = 5;
            var membre = "<?php echo $_SESSION['id']; ?>";
            $("#afficherPlusConseil").click(function(){
                articleCount = articleCount + 5;
                $("#listeArticle").load("Modele/loadArticleConseilles.php", {
                    articleNewCount: articleCount,
                    membre : membre
                });
            });
        });
    </script>
    <script> 
        $(document).ready(function() {
            var articleCount = 5;
            var categorie = "<?php echo $_GET['souscategorie']; ?>";
            $("#afficherPlusCategorieDeconnecte").click(function(){
                articleCount = articleCount + 5;
                $("#listeArticle").load("Modele/loadArticleCategorieDeco.php", {
                    articleNewCount: articleCount,
                    categorie: categorie
                });
            });
        });
    </script>
    <title>OKAZOU</title>
</head>
<body>
<header>
<div id="contentFlex"> <a href="./accueil.php"><img  class="logo" src ="./Images/logo.png"></a>
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
</header>
   <div><?php echo($descriptif) ?></div>
   
   <div id="listeArticle"> <?php echo($articleCategorie) ?> </div>
   <?php if(!empty($_GET['categorie']) && $_SESSION['etatConnexion'] == true) {
     echo('<button id="afficherPlusCategorieConnecte">Afficher Plus</button>');
    } ?>
    <?php if(!empty($_GET['categorie']) && $_SESSION['etatConnexion'] == false) {
     echo('<button id="afficherPlusCategorieDeconnecte">Afficher Plus</button>');
    } ?>
    <?php if(empty($_GET['categorie']) && $_SESSION['etatConnexion'] == true) {
      if($nombreFavoris > 10) {
     echo('<button id="afficherPlusConseil">Afficher Plus</button>');
      }
    } ?>
    <?php if(empty($_GET['categorie']) && $_SESSION['etatConnexion'] == false) {
    echo('<h1>Quelques articles au hasard :</h1>
    <div id="contentFlex">'.$item[rand(0,sizeof($listeArticle)-1)].$item[rand(0,sizeof($listeArticle)-1)].$item[rand(0,sizeof($listeArticle)-1)].$item[rand(0,sizeof($listeArticle)-1)].$item[rand(0,sizeof($listeArticle)-1)].'</div>');} ?>
</body>
</html>