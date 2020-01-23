<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="../CSS/accueil.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h2>Nous serions désolés de vous voir partir</h2>
    <h2>Etes-vous certain de vouloir supprimer votre compte ?</h2>
    <div><form action="suppression_compte.php">
        <input type="hidden" name="suppression" value="true"></input>
        <button type="submit"> Oui je souhaite supprimer mon compte </button>
    </form>
    <br>
    <form action="voir_profil.php">
        <button type="submit"> Non, OKAZOU c'est trop bien ! </button>
    </form>
</div>
</body>
</html>