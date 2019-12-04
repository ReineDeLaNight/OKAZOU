<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h2>Nous serions désolés de vous voir partir</h2>
    <h2>Etes-vous certain de vouloir supprimer votre compte ?</h2>
    <form action="suppression_compte.php">
        <input type="hidden" name="suppression" value="true"></input>
        <button type="submit"> Oui je souhaite supprimer mon compte </button>
    </form>
    <form action="voir_profil.php">
        <button type="submit"> Non, OKAZOU c'est trop bien ! </button>
    </form>
</body>
</html>