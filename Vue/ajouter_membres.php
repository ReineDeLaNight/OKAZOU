<?php 

?>
<h1>Inscription</h1>
       <form action="ajouter_membres.php" method="get" class="inscription">
       <div class="section"></div>
    <div class="inner-wrap">
     <label> Utilisateur: </label> <input type="text" name="pseudo"/> 
</div>
<div class="section"></div>
    <div class="inner-wrap">
     <label> Mot de Passe: </label> <input type="text" name="mdp"/>
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
     <label> Date de Naissance:</label> <input type="date" name="dateNaissance" /> 
</div>
<div class="section"></div>
    <div class="inner-wrap">
     <label> Ville :</label> <input type = "text" name="ville">  
</div>
<div class="button-section">
  <input type='submit' value=Ajouter name='ajout' ><label> </form>

  <form action="../Controleur/voir_membres.php">
        <button type="submit">Voir les membres</button>
    </form>