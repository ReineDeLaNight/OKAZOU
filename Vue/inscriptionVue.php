<?php
  
?>
<html>
    <head>
        <title> Page de connexion </title>
    </head>

    <body>
		<h1>Inscription</h1>
       <form action="inscriptionControleur.php" method="get" class="inscription">
     <p> Utilisateur: </p> <input type="text" name="pseudo"/> <?php if(!empty($_GET['SignUp'])) { echo($erreurVerif[1][0]); echo($erreurVerif[4][0]); } ?>
     <p> Mot de Passe: </p> <input type="text" name="mdp"/> <?php if(!empty($_GET['SignUp'])) { echo($erreurVerif[2][0]); } ?>
     <p> Sexe :</p> <select name="sexe">
        <option value="femme" >Femme</option>
        <option value="homme" >Homme</option>
      </select>
     <p> Date de Naissance:</p> <input type="date" name="dateNaissance" /> <?php if(!empty($_GET['SignUp'])) { echo($erreurVerif[3][0]); } ?>
     <p> Ville :</p> <input type = "text" name="ville">  <?php if(!empty($_GET['SignUp'])) { echo($erreurVerif[5][0]); } ?>
    <p> <input type='submit' value=Inscription name='SignUp' ><p> </form>
    <?php if(!empty($_GET['SignUp'])) { echo($erreurVerif[0][0]); } ?>
    </body>
</html>