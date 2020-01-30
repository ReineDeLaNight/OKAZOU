<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="../CSS/profil.css" rel="stylesheet">
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>
    
    <div class="form-style-10">
        <h1>Entrez vos informations de connexion </h1>
    <form action="./connexion.php" method="GET">
    <div class="section"></div>
    <div class="inner-wrap">
        <label>Pseudo<input type="text" name="pseudo"></label>
</div>
<div class="section"></div>
    <div class="inner-wrap">
        <label>Mot de passe<input type="password" name="mdp"></label>
        </div>
        <div class="button-section">
        <input type="hidden" name="premiereConnexion" value="false">
        <input type="submit" value="Confirmer"> 
        <?php echo $erreurAff; ?>
</div>
</form>
<form action="../accueil.php">
<input value="Retour à l'accueil" type="submit">
         </form>
   
</body>
</html>