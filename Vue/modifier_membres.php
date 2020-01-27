<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OKAZOU</title>
</head>
<body>
<h1>Infos du membre : </h1>
    <?php echo($membre); ?>
    <h1>Modifiez les infos du membre</h1>
       <form action="modifier_membres.php" method="get" class="inscription">
       <div class="section"></div>
    <div class="inner-wrap">
     <label> Utilisateur: </label> <input type="text" name="pseudo"/> <?php if(!empty($_GET['SignUp'])) { echo($erreurVerif[1][0]); echo($erreurVerif[4][0]); } ?>
</div>
<div class="section"></div>
    <div class="inner-wrap">
     <label> Mot de Passe: </label> <input type="text" name="mdp"/> <?php if(!empty($_GET['SignUp'])) { echo($erreurVerif[2][0]); } ?>
</div>
<div class="section"></div>
    <div class="inner-wrap">
     <label> Sexe :</label> <select name="sexe">
        <option value="femme" >Femme</option>
        <option value="homme" >Homme</option>
      </select>
</div>
<div class="section"></div>
    <div class="inner-wrap">
     <label> Date de Naissance:</label> <input type="date" name="dateNaissance" /> <?php if(!empty($_GET['SignUp'])) { echo($erreurVerif[3][0]); } ?>
</div>
<div class="section"></div>
    <div class="inner-wrap">
     <label> Ville :</label> <input type = "text" name="ville">  <?php if(!empty($_GET['SignUp'])) { echo($erreurVerif[5][0]); } ?>
</div>
<div class="button-section">
<input type="hidden" name=id value="<?php echo($_GET['id']);?>">
  <input type='submit' value=Modifier name='modif' ><label> </form>
  <form action="./voir_membres.php">
          <button type="submit"> Voir les membres </button>
         </form>
</body>
</html>