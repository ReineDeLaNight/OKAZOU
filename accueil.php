<?php
    session_start();
    
    if (!isset($_SESSION['etatConnexion'])) { 
        $_SESSION['etatConnexion'] = false;
        $boutonUtilisateur = 
        '<form action="./Controleur/connexion.php">
            <button type="submit">Connexion</button>
        </form>
        <form action="./Controleur/inscription.php">
            <button type="submit">Inscription</button>
        </form>';
    } else if ($_SESSION['etatConnexion'] == true) {
        $boutonUtilisateur = 
        '<form action="./Controleur/voir_profil.php">
            <button type="submit">Voir le profil</button>
        </form>
        <form action="./Controleur/deconnexion.php">
            <button type="submit">Se déconnecter</button>
        </form>';
    } else {
        $_SESSION['etatConnexion'] = false;
        $boutonUtilisateur = 
        '<form action="./Controleur/connexion.php">
            <button type="submit">Connexion</button>
        </form>
        <form action="./Controleur/inscription.php">
            <button type="submit">Inscription</button>
        </form>';
    }
    
    include("./Vue/accueil.php");
?>

