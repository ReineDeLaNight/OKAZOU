<?php
  
?>
<html>
    <head>
        <title> Ajouter des articles </title>
    </head>

    <body>
		<h1>Ajoutez un article</h1>
       <form action="ajout_articles.php" method="get" >
     <p> Ajoutez une description (45  caracteres max) </p> <input type="text" name="description"/> 
     <p> Prix (en euros) </p> <input type="number" name="prix" step="0.01"/> 
     <p> Ajoutez des mots clés pour le référencement </p> <input type="text" name="keyword"/>
     <p> Couleur</p> <select name="couleur">
        <option value="noir" >Noir</option>
        <option value="gris" >Gris</option>
        <option value="blanc" >Blanc</option>
        <option value="beige" >Beige</option>
        <option value="orange" >Orange</option>
        <option value="rouge" >Rouge</option>
        <option value="rose" >Rose</option>
        <option value="violet" >Violet</option>
        <option value="bleuclair" >Bleu Clair</option>
        <option value="bleu" >Bleu</option>
        <option value="marine" >Marine</option>
        <option value="turquoise" >Turquoise</option>
        <option value="vert" >Vert</option>
        <option value="vertfonce" >Vert foncé</option>
        <option value="marron" >Marron</option>
        <option value="jaune" >Jaune</option>
      </select>
     <p>Etat :</p> <select name="etat">
        <option value="neufEtiquette"> Neuf, avec étiquette </option>
        <option value="neuf"> Neuf </option>
        <option value="tresBonEtat"> Très bon état </option>
        <option value="bonEtat"> Bon état </option>
        <option value="satisfaisant"> Satisfaisant </option>
     </select>
     <p> Ajoutez de 1 a 3 photos :</p> <input type = "file" name="photo1" accept=".png"> <input type = "file" name="photo2" accept=".png"> <input type = "file" name="photo3" >
     <p>Catégorie :</p> <select name="categorie">
        <optgroup label ="Hommes">
        <option value="hVestesManteauxBlousons"> Vestes Manteaux & Blousons </option>
        </optgroup>
        <optgroup label ="Femmes">
        <option value="fVestesManteauxBlousons"> Vestes Manteaux & Blousons </option>
        </optgroup>
        <optgroup label ="Enfants">
        <option value="eVestesManteauxBlousons"> Vestes Manteaux & Blousons </option>
        </optgroup>
     </select>
     <p>Taille</p> <select name="taille">
        <optgroup label ="Hauts">
        <option value="hxs"> XS </option>
        <option value="hs"> S </option>
        <option value="hm"> M </option>
        <option value="hl"> L </option>
        <option value="hxl"> XL </option>
        </optgroup>
        <optgroup label ="Chaussures">
        <option value="c38"> 38 </option>
        <option value="c38.5"> 38.5 </option>
        <option value="c39"> 39 </option>
        <option value="c39.5"> 39.5 </option>
        <option value="c40"> 40 </option>
        <option value="c40.5"> 40.5 </option>
        <option value="c41"> 41 </option>
        <option value="c41.5"> 41.5 </option>
        <option value="c42"> 42 </option>
        <option value="c42.5"> 42.5 </option>
        <option value="c43"> 43 </option>
        <option value="c43.5"> 43.5 </option>
        <option value="c44"> 44 </option>
        <option value="c44.5"> 44.5 </option>
        <option value="c45"> 45 </option>
        <optgroup>
        <optgroup label ="Pantalons">
        <optgroup label ="Hommes">
        <option value="pflemme"> MEURS </option>
        <optgroup>
        <optgroup label ="Femmes">
        <option value="de ouf"> MEURS </option>
        <optgroup>
        <optgroup>
     </select>
     <p>Site</p> <select name="site">
     <option value="vinted"> Vinted </option>
     <option value="vestiairecollective"> Vestiaire Collective </option>
     </select>
     <p>Marque</p> <select name="marque">
     <option value="don dada"> Don Dada</option>
     </select>
    <p> <input type='submit' value=ok name='valide' ><p> </form>
    </body>
</html>