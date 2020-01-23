<?php

?>
<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="../CSS/profil.css" rel="stylesheet">
<title>OKAZOU</title>
</head>
<body>
<div id="profil">
<h1>OKAZOU</h1>

<?php if(empty($_GET['modif'])) {
    echo($afficherProfil);
    echo('<p>
    <form action="voir_profil.php" method="get">
        <input type="submit" value="Modifier" name="modif">
    </form>
</p>
<p>
    <form action="../Controleur/confirmation_suppression.php">
        <button type="submit">Supprimer le compte</button>
    </form>
</p>');
 } 
?>
<?php if(!empty($_GET['modif'])) {
    echo(' 
    <div class="form-style-10">
    <h1>Modifiez vos Infos</h1>
    <form action="voir_profil.php" method="get">
    <div class="section"></div>
    <div class="inner-wrap">
    <label> Mot de Passe: <input type="text" name="mdp"/> </label>'.$erreurVerif[1][0].'
    <label> Sexe :</label> <select name="sexe"> 
    <option value="femme" >Femme</option>
    <option value="homme" >Homme</option>
    </select>
    <label> Date de Naissance:</label> <input type="date" name="dateNaissance" />'.$erreurVerif[2][0].' 
    <label> Ville :</label> <input type = "text" name="ville">'.$erreurVerif[3][0].' 
    </div>
    <div class="button-section">
    <input type="submit" value="Mettre à jour" name="maj">
    <input type="hidden" name=modif value="ok">'.$erreurVerif[0][0].' 
    </div>
    </form>  
    ');}
    ?>
</div>
<form action="../accueil.php">
      <button type="submit"> Retour à l'accueil </button>
    </form>
    </body>
    </html>