<?php

?>
<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <title>OKAZOU</title>
    </head>
    <body>
    <h1>OKAZOU</h1>
<?php
    if(empty($_GET['modif'])) {
        echo ("<table border>"); 
        for($i = 1; $i < count($infoProfil)/2; $i++){
            echo("<tr>");
            echo("<td>".$infoProfil[$i]."</td>"); 
            echo("</tr>");  
        }
    echo ("</table>");
?>
    <form action='voir_profil.php' method='get'>
    <input type='submit' value='Modifier' name='modif'>
    </form>
    <?php
}
    else {
?>
        <h1>Modifiez vos Infos</h1>
       <form action="voir_profil.php" method="get">
     <p> Utilisateur: </p> <input type="text" name="pseudo"/> <?php if(!empty($_GET['maj'])) { echo($erreurVerif[1][0]); echo($erreurVerif[4][0]); } ?>
     <p> Mot de Passe: </p> <input type="text" name="mdp"/> <?php if(!empty($_GET['maj'])) { echo($erreurVerif[2][0]); } ?>
     <p> Sexe :</p> <select name="sexe"> 
        <option value="femme" >Femme</option>
        <option value="homme" >Homme</option>
      </select>
     <p> Date de Naissance:</p> <input type="date" name="dateNaissance" /> <?php if(!empty($_GET['maj'])) { echo($erreurVerif[3][0]); } ?>
     <p> Ville :</p> <input type = "text" name="ville">  <?php if(!empty($_GET['maj'])) { echo($erreurVerif[5][0]); } ?>
    <p> <input type='submit' value='Mettre à jour' name='maj' ><p> </form>
    <?php if(!empty($_GET['maj'])) { echo($erreurVerif[5][0]); } ?>

   <?php
}
?>
    </body>
</html>