<?php
  
?>
<html>
    <head>
        <title> Ajouter des articles </title>
    </head>

    <body>
		<h1>Ajoutez un article</h1>
       <form action="ajout_articles.php" method="get" >
         <p> Nom </p> <input type="text" name="nom"/>
         <p> Description </p> <input type="text" name="description"/> 
         <p> Lien </p> <input type="text" name="lien"/>
         <p> Prix (en euros) </p> <input type="number" name="prix" step="0.01"/> 
         <p> Couleur </p> <input type="text" name="couleur"/>
         <p>Etat :</p> <select name="etat">
         
        <option value="Neuf, avec étiquette"> Neuf, avec étiquette </option>
        <option value="Neuf"> Neuf </option>
        <option value="Très bon état"> Très bon état </option>
        <option value="Bon état"> Bon état </option>
        <option value="Satisfaisant"> Satisfaisant </option>
     </select>
     <p> <b>Ajoutez de 1 a 3 photos :</b> <input type="text" name="photo1"> <input type="text" name="photo2"> <input type="text" name="photo3"> </p>
     <p><b>Catégorie à ajouter:</b></p>  <select name="choix_cat">
         <option value="femmes"> Femmes </option>
         <option value="hommes"> Hommes </option>
         <option value="enfants"> Enfants </option>
     </select>
     <p><b>Catégorie :</b></p> 
      <?php echo $categorie ?>
     
     <?php echo $taille ?> 
        
     <h2>Site</h2> <select name="site">
     <option value="vinted"> Vinted </option>
     <option value="vestiairecollective"> Vestiaire Collective </option>
     </select>
     <h2>Marque</h2>
     <?php echo $marque ?>
    <p> <input type='submit' value=ok name='valide' ><p> </form>
    </body>
</html>