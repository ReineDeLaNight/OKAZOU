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
            var pere = "<?php echo $_GET['pere']; ?>";
            var membre = "<?php echo $_SESSION['id']; ?>";
            $("#afficherPlusCategorieConnecte").click(function(){
                articleCount = articleCount + 5;
                $("#listeArticle").load("Modele/loadArticleCategorieCo.php", {
                    articleNewCount: articleCount,
                    categorie: categorie,
                    membre : membre,
                    pere: pere
                });
            });
        });
    </script>
    <script> 
        $(document).ready(function() {
            var articleCount = 5;
            var min = "<?php echo $_GET['min']; ?>";
            var max = "<?php echo $_GET['max']; ?>";
            var categorie = "<?php echo $_GET['categorie']; ?>";
            var souscategorie = "<?php echo $_GET['souscategorie']; ?>";
            var pere = "<?php echo $_GET['pere']; ?>";
            $("#afficherPlusPrixDeco").click(function(){
                articleCount = articleCount + 5;
                $("#listeArticle").load("Modele/loadArticlePrixDeco.php", {
                    articleNewCount: articleCount,
                    categorie: categorie,
                    pere: pere,
                    min: min, 
                    souscategorie: souscategorie,
                    max: max
                });
            });
        });
    </script>
    <script> 
        $(document).ready(function() {
            var articleCount = 5;
            var membre = "<?php echo $_SESSION['id']; ?>";
            var min = "<?php echo $_GET['min']; ?>";
            var max = "<?php echo $_GET['max']; ?>";
            var categorie = "<?php echo $_GET['categorie']; ?>";
            var souscategorie = "<?php echo $_GET['souscategorie']; ?>";
            var pere = "<?php echo $_GET['pere']; ?>";
            $("#afficherPlusPrixCo").click(function(){
                articleCount = articleCount + 5;
                $("#listeArticle").load("Modele/loadArticlePrixCo.php", {
                    articleNewCount: articleCount,
                    categorie: categorie,
                    pere: pere,
                    membre: membre,
                    min: min, 
                    souscategorie: souscategorie,
                    max: max
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
            var pere = "<?php echo $_GET['pere']; ?>";
            $("#afficherPlusCategorieDeconnecte").click(function(){
                articleCount = articleCount + 5;
                $("#listeArticle").load("Modele/loadArticleCategorieDeco.php", {
                    articleNewCount: articleCount,
                    categorie: categorie,
                    pere: pere
                });
            });
        });
    </script>
    <title>OKAZOU</title>
</head>
<body>
<header>
<div id="contentFlexHop"><a href="./accueil.php">OKAZOU</a></div>
<div id="contentFlex">
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
<div><?php echo $filtre; ?></div>
<div><?php echo $tri_prix; ?></div>
<?php echo $recherche; ?>
</header>

   <div><?php echo($descriptif) ?></div>
   <div id="listeArticle"> <?php echo($articleCategorie) ?> </div>
   <?php 
  if(!empty($_GET['categorie']) && !empty($_GET['souscategorie']) && empty($_GET['filtre']) && empty($_GET['min']) && $_SESSION['etatConnexion'] == true) {
    echo('<button id="afficherPlusCategorieConnecte">Afficher Plus</button>');
  }
  if(!empty($_GET['categorie']) && !empty($_GET['souscategorie']) && empty($_GET['filtre']) && empty($_GET['min']) && $_SESSION['etatConnexion'] == false) {
     echo('<button id="afficherPlusCategorieDeconnecte">Afficher Plus</button>');
  }
  if(empty($_GET['categorie']) && $_SESSION['etatConnexion'] == true && empty($_GET['min']) && empty($_GET['min']) && empty($_GET['recherche'])) {
    if($nombreFavoris > 10) {
      echo('<button id="afficherPlusConseil">Afficher Plus</button>');
    }
  }
  if (!empty($_GET['min']) && !empty($_GET['max']) && !empty($_GET['categorie']) && empty($_GET['recherche']) && $_SESSION['etatConnexion'] == false) {
    echo('<button id="afficherPlusPrixDeco">Afficher Plus</button>');
  }
  if (!empty($_GET['min']) && !empty($_GET['max']) && !empty($_GET['categorie']) && empty($_GET['recherche']) && $_SESSION['etatConnexion'] == true) {
    echo('<button id="afficherPlusPrixCo">Afficher Plus</button>');
  }
  if(empty($_GET['categorie']) && $_SESSION['etatConnexion'] == false) {
    
    echo('<h1>Quelques articles au hasard :</h1>
    <div id="contentFlex">'.$item[rand(0,sizeof($listeArticle)-1)].$item[rand(0,sizeof($listeArticle)-1)].$item[rand(0,sizeof($listeArticle)-1)].$item[rand(0,sizeof($listeArticle)-1)].$item[rand(0,sizeof($listeArticle)-1)].'</div>');
  }
    ?>
</body>
</html>