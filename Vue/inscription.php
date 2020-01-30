<?php
  
?>
<html>
    <head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="../CSS/profil.css" rel="stylesheet">
        <title> Page de connexion </title>
    </head>

    <body>
    <div class="form-style-10">
		<h1>Inscription</h1>
       <form action="inscription.php" method="get" class="inscription">
       <div class="section"></div>
    <div class="inner-wrap">
     <label> Utilisateur: </label> <input type="text" name="pseudo"/> <?php if(!empty($_GET['SignUp'])) { echo($erreurVerif[1][0]); echo($erreurVerif[4][0]); } ?>
</div>
<div class="section"></div>
    <div class="inner-wrap">
     <label> Mot de Passe: </label> <input type="password" name="mdp"/> <?php if(!empty($_GET['SignUp'])) { echo($erreurVerif[2][0]); } ?>
</div>
<div class="section"></div>
    <div class="inner-wrap">
     <label> Sexe :</label> <select name="sexe">
        <option value="femme" >Femme</option>
        <option value="homme" >Homme</option>
        <option value="autre" >Autre</option>
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
  <input type='submit' value=Inscription name='SignUp' ><label> </form>
    <?php if(!empty($_GET['SignUp'])) { echo($erreurVerif[0][0]); } ?>
    <form action="../accueil.php">
<input value="Retour à l'accueil" type="submit">
         </form>
</div>

    </body>
</html>