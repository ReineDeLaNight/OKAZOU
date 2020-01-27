<?php
function regex_all($page_start, $page_end, $categorie) {
    
    
    $page = $page_start;
    while ($page <= $page_end) {
        $handle = curl_init();
        
        $url = "https://us.vestiairecollective.com/$categorie/p-$page/";
        //echo $url."<br>";
        // Set the url
        curl_setopt($handle, CURLOPT_URL, $url);

        // Set the result output to be a string.
        curl_setopt($handle, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        
        $headers = [
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36'
        ];

        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);

        $output = curl_exec($handle);

        

        print_r($output);

        //$regex = preg_match_all('%itemprop="brand">[a-zA-Z]+%', $output, $matches); // marque
        $regex = preg_match_all('%itemprop="url" target="_self" href="[a-zA-Z0-9-_\.\/?=&]+%', $output, $matches); // url article
       
        //print_r(curl_getinfo($handle));
        curl_close($handle);

        $j = 0;
        while ($j < 1) { //remplacer par $regex
            echo "<br><h1>j = $j</h1><br>";
            $url_article = str_replace('itemprop="url" target="_self" href="', 'https://us.vestiairecollective.com', $matches[0][$j]);
            //echo "$url_article<br>";
            $handle = curl_init();
    
            // Set the url
            curl_setopt($handle, CURLOPT_URL, $url_article);
            curl_setopt($handle, CURLOPT_ENCODING, '');

            // Set the result output to be a string.
            curl_setopt($handle, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
         
            $loaded_page = curl_exec($handle);
            //echo $loaded_page;
            
            curl_close($handle);
            
            //$regex_page = preg_match_all('%<div _ngcontent-vc-app-c40[0-9]{1,4}="" itemprop="name">[áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'a-zA-Z0-9-_\.\/?=&\s\d]+%', $loaded_page, $nom_article);
            $regex_reference = preg_match('%Référence : [0-9]+%', $loaded_page, $reference);
            $regex_reference = preg_match_all('%[0-9]+%', $reference[0], $reference);

            $reference = $reference[0];

            $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');

            $req = $bdd->prepare("SELECT * FROM article WHERE reference = :reference");

            $req->bindParam(':reference',$reference,PDO::PARAM_INT);
            $req->execute() or die(print_r($req->errorInfo(), TRUE));
            
            if (!$bob = $req->fetch()) { // Si article existe déjà

                // nom_article
                $regex_article = preg_match('%<div _ngcontent-sc[0-9]{1,}="" class="productTitle__name"> [áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'a-zA-Z0-9-_\.\/?=&\s\d]+%', $loaded_page, $nom_article);
                
                $regex_article = preg_match('%> [áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'a-zA-Z0-9-\.\/?&\s\d]+%', $nom_article[0], $nom_article);
                
                $nom_article = str_replace(">", "", $nom_article[0]);
                

                // description
                $regex_description = preg_match('%<div _ngcontent-sc[0-9]{1,4}="" class="sellerDescription"><p _ngcontent-sc[0-9]{1,4}=""> [,:áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'a-zA-Z0-9-_\.\/?=&\s\d]+%', $loaded_page, $description);
                $regex_description = preg_match('%> [,:áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'a-zA-Z0-9-\.\/?=&\s\d]+%', $description[0], $description);
                $regex_description = preg_match('%[,:áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'a-zA-Z0-9-\.\/?=&\s\d]+%', $description[0], $description);
                
                //prix
                $regex_prix = preg_match('%<span _ngcontent-sc[0-9]{1,4}="" class="productPrice__price">[0-9.,]+%', $loaded_page, $prix);
                //print_r($prix);
                $regex_prix = preg_match('%>[0-9]{1,4}%', $prix[0], $prix);
                
                $prix = str_replace(">", "", $prix[0]);

                // data (possède plusieurs éléments)
                $regex_data = preg_match_all('%<li _ngcontent-sc[0-9]{1,4}="">[,:áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'a-zA-Z0-9-_\.\/?=&\s\d]+%', $loaded_page, $data);
                //var_dump($data);

                // couleur
                $regex_couleur = preg_match_all('%[,:áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'a-zA-Z0-9-\.\/?=&\s\d]+%', $data[0][7], $couleur);
                $regex_couleur = preg_match('%: [,:áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'a-zA-Z0-9-_\.\/?=&\s\d]+%', $couleur[0][2], $couleur);
                $regex_couleur = preg_match('%[,áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'a-zA-Z0-9-_\.\/?=&\s\d]+%', $couleur[0], $couleur);

                // etat
                $regex_etat = preg_match('%<span _ngcontent-sc[0-9]{1,4}="">État : [,áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'a-zA-Z0-9-_\.\/?=&\s\d]+%', $loaded_page, $etat);
                $regex_etat = preg_match('%: [,áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'a-zA-Z0-9-_\.\/?=&\s\d]+%', $etat[0], $etat);
                $regex_etat = preg_match('%[,áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'a-zA-Z0-9-_\.\/?=&\s\d]+%', $etat[0], $etat);

                // image
                $regex_image = preg_match_all('%<img _ngcontent-sc[0-9]{1,4}="" class="image" loading="lazy" width="500" height="0" src="[;&:,áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'a-zA-Z0-9-_\.\/?=&\s\d]+%', $loaded_page, $image);
                for ($i = 0; $i < sizeof($image[0]); $i++) {
                    $regex_image = preg_match('%https[;&:,áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'a-zA-Z0-9-_\.\/?=&\s\d]+%', $image[0][$i], $match);
                    $tab_image[$i] = $match[0];
                }


                // taille
                $case = taille_case ($data); // trouver la case ou se situe la taille (n'est pas la même pour tous les produits)

                $regex_taille = preg_match('% [0-9A-Z]{1,5} [A-Za-z0-9-]+| [0-9]{1}%', $data[0][$case], $taille);

                if (sizeof($taille) == 0) {
                    $regex_taille = preg_match('%[A-Z]%', $data[0][3], $taille_valeur);
                    $taille_categ = NULL;
                } else if (strlen($taille[0]) == 2) {
                    $regex_taille = preg_match('%[0-9]%', $taille[0], $taille_valeur);
                    $taille_categ = NULL;
                } else {
                    $regex_taille = preg_match('%[0-9A-Z]{1,5} %', $taille[0], $taille_valeur);
                    $taille_categ = str_replace($taille_valeur[0], "", $taille[0]);
                    $taille_categ = str_replace(" ", "", $taille_categ);
                }
                
                $taille_valeur = str_replace(" ", "", $taille_valeur[0]);
                //echo $taille_valeur[0]."<br>";
                //echo $taille_categ;

                // categorie
                $regex_scategorie = preg_match('%: [,áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'a-zA-Z0-9-_\.\/?=&\s\d]+%', $data[0][3], $scategorie);

                $scategorie = $scategorie[0];

                $scategorie = substr($scategorie, 2);
                $scategorie = str_replace(".", " ", $scategorie);

                // marque
                $regex_marque = preg_match('%<a _ngcontent-sc[0-9]{1,5}="" class="" target="_self" href="/[a-zA-Z-]+/">[,áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒa-zA-Z\/\'\s-]+%', $loaded_page, $marque);
                //print_r($marque);
                $regex_marque = preg_match('%>[,áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒa-zA-Z\/\'\s-]+%', $marque[0], $marque);

            } 
            $matches[$j]['nom'] = $nom_article;
            $matches[$j]['description'] = $description[0];
            $matches[$j]['lien'] = $url_article;
            $matches[$j]['prix'] = $prix[0];
            $matches[$j]['prix'] .= $prix[1];
            $matches[$j]['couleur'] = $couleur[0];
            /*$matches[$j]['etat'] = $nom_categorie[0];
            $matches[$j]['photo1'] = $nom_categorie[0];
            $matches[$j]['photo2'] = $nom_categorie[0];
            $matches[$j]['photo3'] = $nom_categorie[0];
            $matches[$j]['taille'] = $nom_categorie[0];
            $matches[$j]['categorie'] = $nom_categorie[0];
            $matches[$j]['site'] = $nom_categorie[0];
            $matches[$j]['marque'] = $nom_categorie[0];
            $matches[$j]['reference'] = $nom_categorie[0];*/

            //echo $matches[$j]['nom'];
            //echo $matches[$j]['description'];
            //echo $matches[$j]['lien'];
            //echo $matches[$j]['prix'];
            echo $matches[$j]['couleur'];
            $j++;
            
            // initialisation des variables
            $taille_categ = "";
            
        }

        $page++;
    }
    
    return $matches;
}

$page_start = 1;
$page_end = 3;
$categorie = "women-clothing";

$data = regex_all($page_start, $page_end, $categorie);
//print_r($data);
// Fonctions utiles

function taille_case ($data) {
    for ($k = 0; $k < sizeof($data[0]); $k++) { // Trouver la case de la taille
        $regex_test_case = preg_match('%Taille%', $data[0][$k], $match);
        $regex_test_case2 = preg_match('%Size%', $data[0][$k], $match);
        
        if ($regex_test_case > 0 || $regex_test_case2) {
            return $k;
        }
    }
    echo "La taille n'existe pas pour ce produit";
}

?>