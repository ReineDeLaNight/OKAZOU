<?php
    session_start();
    include("./Modele/accueil.php");
    if (!isset($_SESSION['etatConnexion'])) {  // Si l'utilisateur n'est pas connecté
        $_SESSION['etatConnexion'] = false;
        $boutonUtilisateur = 
        '<form action="./Controleur/connexion.php">
            <button type="submit">Connexion</button>
        </form>
        <form action="./Controleur/inscription.php">
            <button type="submit">Inscription</button>
        </form>';
    } else if ($_SESSION['etatConnexion'] == true && $_SESSION['role'] == 'a') { // Si l'utilisateur est admin
        $boutonUtilisateur = 
        '<form action="./Controleur/voir_profil.php">
            <button type="submit">Voir le profil</button>
        </form>
        <form action="./Controleur/deconnexion.php">
            <button type="submit">Se déconnecter</button>
        </form>
        <form action="./Vue/action_admin.php">
            <button type="submit">Page de contrôle admin</button>
        </form>
        <form action="./Controleur/voir_prod_consult.php">
            <button type="submit">Historique</button>
        </form>
        <form action="./Controleur/voir_favoris.php">
            <button type="submit">Favoris</button>
        </form>';
    } else if ($_SESSION['etatConnexion'] == true) { // Si l'utilisateur est connecté
        $boutonUtilisateur = 
        '<form action="./Controleur/voir_profil.php">
            <button type="submit">Voir le profil</button>
        </form>
        <form action="./Controleur/deconnexion.php">
            <button type="submit">Se déconnecter</button>
        </form>
        <form action="./Controleur/voir_prod_consult.php">
            <button type="submit">Historique</button>
        </form>
        <form action="./Controleur/voir_favoris.php">
            <button type="submit">Favoris</button>
        </form>';
    } else { // A voir ce que ça fait là
        $_SESSION['etatConnexion'] = false;
        $boutonUtilisateur = 
        '<form action="./Controleur/connexion.php">
            <button type="submit">Connexion</button>
        </form>
        <form action="./Controleur/inscription.php">
            <button type="submit">Inscription</button>
        </form>';
    }
    $listeArticle = listeArticle();
    for($i=0; $i<sizeof($listeArticle) ;$i++)
    {
        $item[$i] = createItem($listeArticle[$i]);
    }
    include("./Vue/accueil.php");
    //$listeArticle[rand(0,sizeof($listeArticle)-1)]
?>

