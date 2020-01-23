<?php
    
    ajout_site();

    $main_categorie = [
        'femmes',
        'hommes',
        'enfants'
    ];

    for ($i = 0; $i < sizeof($main_categorie); $i++) {
        parcourir_categorie($main_categorie[$i]);
    }

    function parcourir_categorie($main_categorie) {
        $file = fopen('../'.$main_categorie.'.csv', "r");
        
        $i = 0;
        $population = 0;
        while ($data_csv[$i] = fgetcsv($file, 1024, ',')) {  // CSV -> tableau 2 dimensions
            $i++;
        }

        unset($data_csv[0]); // première ligne inutile;
        $data_csv = array_values($data_csv); // Réarrangement du tableau après suppression 1ere ligne

        $data['main_categorie'] = $main_categorie;
        $site = 1; 
        for ($i = 0; $i < sizeof($data_csv) - 1; $i++) {
            $data[$i] = [];
            
            $data[$i]['categorie'] = change_into_et($data_csv[$i][18]);
            $data[$i]['lien'] = $data_csv[$i][3];
            $data[$i]['photo1'] = convert_photo($data_csv[$i][5]);
            $data[$i]['photo2'] = convert_photo($data_csv[$i][7]);
            $data[$i]['photo3'] = convert_photo($data_csv[$i][9]);
            $data[$i]['marque'] = $data_csv[$i][11];
            $data[$i]['taille'] = $data_csv[$i][12];
            $data[$i]['etat'] = $data_csv[$i][13];
            $data[$i]['couleur'] = $data_csv[$i][14];
            $data[$i]['description'] = remove_emoji($data_csv[$i][17]);
            $data[$i]['prix'] = convert_to_price($data_csv[$i][10]);
            $data[$i]['nom'] = remove_emoji($data_csv[$i][19]);


            $categorie = ajout_categorie($data['main_categorie'], $data[$i]['categorie']);
            $taille = ajout_taille($data[$i]['taille'], $data[$i]['categorie']);
                                                                                         // L'id de vinted dans la table site est 1
            $marque = ajout_marque($data[$i]['marque']);

            ajout_article($data[$i]['description'], $data[$i]['lien'], $data[$i]['prix'], $data[$i]['couleur'], $data[$i]['etat'], $data[$i]['photo1'], $data[$i]['photo2'], $data[$i]['photo3'], $taille, $categorie, $site, $marque, $data[$i]['nom']);
        }
    }

    /*//////////////////////////////////////////////////
    ///////////////////Fin execution////////////////////
    //////////////////////////////////////////////////*/


    ////////////////////////////
    // Fonction sur les strings
    ////////////////////////////
    function change_into_et($categorie) {
        $categorie = str_replace('&', 'et', $categorie);
        return $categorie;
    }

    function convert_photo($string_photo) {
        if (empty($string_photo)) {
            $string_photo = NULL;
        }
        return $string_photo;
    }

    function convert_to_price($string_prix) {
        
        $string_prix = str_replace(" €", "", $string_prix);
        $prix = (float)str_replace(",", ".", $string_prix);

        $prix = number_format($prix , 2, ',', ' ');

        return $prix;
    }

    function remove_emoji($string) {
        $regex_all = '/[\x{0FF0}-\x{1FA95}]/u';
        //$regex_all = '/[\x{00A6}-\x{1FA95}]/u';
        $clear_string = preg_replace($regex_all, '', $string);

        return $clear_string;
    }

    ////////////////
    // Fonctions SQL
    ////////////////

    function ajout_categorie($main_categorie, $categorie) {
        echo "<br>categorie princ: ".$main_categorie."<br>";
        echo "categorie: ".$categorie."<br>";

        if ($main_categorie == "femmes") {
            $pere = 1;
        } else if ($main_categorie == "hommes") {
            $pere = 2;
        } else {
            $pere = 3;
        }

        $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');

        $req = $bdd->prepare('SELECT id FROM categorie WHERE nom_categorie LIKE :categorie AND pere = :pere');
        $req -> bindParam(':categorie',$categorie,PDO::PARAM_STR);
        $req -> bindParam(':pere',$pere,PDO::PARAM_INT);
        $req->execute() or die(print_r($req->errorInfo(), TRUE));

        $id_categorie = $req->fetch();        
        
        var_dump($id_categorie);

        if(!$id_categorie) {
            
            //$req = $bdd->prepare("INSERT IGNORE INTO categorie (nom_categorie, pere) VALUES (:categorie, :pere)");
            $req = $bdd->prepare("INSERT INTO categorie (nom_categorie, pere) VALUES (:categorie, :pere)");
            $req -> bindParam(':categorie',$categorie,PDO::PARAM_STR);
            $req -> bindParam(':pere',$pere,PDO::PARAM_INT);

            $req->execute() or die(print_r($req->errorInfo(), TRUE));

            //$id_categorie++;
        }

        $req = $bdd->prepare("SELECT id FROM categorie WHERE nom_categorie LIKE :categorie AND pere = :pere");
        $req -> bindParam(':categorie',$categorie,PDO::PARAM_STR);
        $req -> bindParam(':pere',$pere,PDO::PARAM_INT);
        $req->execute() or die(print_r($req->errorInfo(), TRUE));

        $id_categorie = $req->fetch();    

        return $id_categorie[0];
    }

    function ajout_taille($taille, $categorie) {

        $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');

        $req = $bdd->prepare("SELECT COUNT(*) FROM taille");

        $req->execute() or die(print_r($req->errorInfo(), TRUE));
        $cpt = $req->fetch();

        $req = $bdd->prepare("SELECT id FROM categorie WHERE nom_categorie = :categorie");
        $req -> bindParam(':categorie',$categorie,PDO::PARAM_STR);

        $req->execute() or die(print_r($req->errorInfo(), TRUE));
        $id_categorie = $req->fetch();

        $req = $bdd->prepare("SELECT id FROM taille WHERE taille LIKE :taille AND categorie = :id_categorie");
        $req -> bindParam(':taille',$taille,PDO::PARAM_STR);
        $req -> bindParam(':id_categorie',$id_categorie[0],PDO::PARAM_INT);

        $req->execute() or die(print_r($req->errorInfo(), TRUE));
        $id_taille = $req->fetch();

        
        

        if ($cpt[0] == 0) {

            $req = $bdd->prepare("INSERT INTO taille(taille, categorie) VALUES(:taille, :id_categorie)");
            $req -> bindParam(':taille',$taille,PDO::PARAM_STR);
            $req -> bindParam(':id_categorie',$id_categorie[0],PDO::PARAM_INT);

            $req->execute() or die(print_r($req->errorInfo(), TRUE));

        } else {
            
            if (!$id_taille) {
                $req = $bdd->prepare("INSERT INTO taille(taille, categorie) VALUES(:taille, :id_categorie)");
                $req -> bindParam(':taille',$taille,PDO::PARAM_STR);
                $req -> bindParam(':id_categorie',$id_categorie[0],PDO::PARAM_INT);

                $req->execute() or die(print_r($req->errorInfo(), TRUE));
                
            }
        }
    
        $req = $bdd->prepare("SELECT id FROM taille WHERE taille LIKE :taille AND categorie = :id_categorie");
        $req -> bindParam(':taille',$taille,PDO::PARAM_STR);
        $req -> bindParam(':id_categorie',$id_categorie[0],PDO::PARAM_INT);
        $req->execute() or die(print_r($req->errorInfo(), TRUE));
        
        $id_taille = $req->fetch();
        
        
        //echo "id à la fin de la fonction".$id_taille[0]."<br>";
        return $id_taille[0];
    }

    function ajout_marque($marque) {
        $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
        

        $req = $bdd->prepare("SELECT id FROM marque WHERE marque LIKE :marque");
        $req -> bindParam(':marque',$marque,PDO::PARAM_STR);

        $req->execute() or die(print_r($req->errorInfo(), TRUE));

        $id_marque = $req->fetch();

        if (!$id_marque) {
            $req = $bdd->prepare("INSERT INTO marque(marque) VALUES(:marque)");
            $req -> bindParam(':marque',$marque,PDO::PARAM_STR);

            $req->execute() or die(print_r($req->errorInfo(), TRUE));

            $id_marque++;
        }

        $req = $bdd->prepare("SELECT id FROM marque WHERE marque = :marque");
        $req -> bindParam(':marque',$marque,PDO::PARAM_STR);

        $req->execute() or die(print_r($req->errorInfo(), TRUE));

        $id_marque = $req->fetch();

        return $id_marque[0];
    }

    function ajout_site() {
        $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');

        $req = $bdd->prepare('SELECT nom FROM site WHERE nom = "Vinted"');
        $req->execute() or die(print_r($req->errorInfo(), TRUE));

        if (!$req->fetch()) {

            $nom = "Vinted";
            $lien = "https://www.vinted.fr/";
            $logo = "https://upload.wikimedia.org/wikipedia/commons/2/29/Vinted_logo.png";
        

            $req = $bdd->prepare("INSERT INTO site(nom, lien, logo) VALUES (:nom, :lien, :logo)");
            $req -> bindParam(':nom',$nom,PDO::PARAM_STR);
            $req -> bindParam(':lien',$lien,PDO::PARAM_STR);
            $req -> bindParam(':logo',$logo,PDO::PARAM_STR);

            $req->execute() or die(print_r($req->errorInfo(), TRUE));
        }
    }

    function ajout_article($description, $lien, $prix, $couleur, $etat, $photo1, $photo2, $photo3, $taille, $categorie, $site, $marque, $nom) {
        //echo "<br>".$lien;
        /*echo $description."<br>";
        echo $prix."<br>";
        echo $couleur."<br>";
        echo $etat."<br>";
        echo $photo1."<br>";
        echo $photo2."<br>";
        echo $photo3."<br>";
        echo $taille."<br>";*/
        //echo "<br>".$categorie;
        /*echo $site."<br>";
        echo $marque."<br>";*/

        //echo "<br>$description";
        //echo "<br>$categorie<br>";

        $bdd = new PDO('mysql:host=localhost;dbname=okazou;charset=utf8', 'root', '');
        $req = $bdd->prepare("SELECT * FROM article WHERE lien LIKE :lien");
        $req -> bindParam(':lien',$lien,PDO::PARAM_STR);

        $req->execute() or die(print_r($req->errorInfo(), TRUE));

        $flag = $req->fetch();

        if (!$flag) {
            $req = $bdd->prepare("INSERT INTO article (description, lien, prix, couleur, etat, photo1, photo2, photo3, taille, categorie, site, marque, nom) VALUES(:description, :lien, :prix, :couleur, :etat, :photo1, :photo2, :photo3, :taille, :categorie, :site, :marque, :nom)");
            
            $req -> bindParam(':description',$description,PDO::PARAM_STR);
            $req -> bindParam(':lien',$lien,PDO::PARAM_STR);
            $req -> bindParam(':prix',$prix,PDO::PARAM_INT);
            $req -> bindParam(':couleur',$couleur,PDO::PARAM_STR);
            $req -> bindParam(':etat',$etat,PDO::PARAM_STR);
            $req -> bindParam(':photo1',$photo1,PDO::PARAM_STR);
            $req -> bindParam(':photo2',$photo2,PDO::PARAM_STR);
            $req -> bindParam(':photo3',$photo3,PDO::PARAM_STR);
            $req -> bindParam(':taille',$taille,PDO::PARAM_INT);
            $req -> bindParam(':categorie',$categorie,PDO::PARAM_INT);
            $req -> bindParam(':site',$site,PDO::PARAM_INT);
            $req -> bindParam(':marque',$marque,PDO::PARAM_INT);
            $req -> bindParam(':nom',$nom,PDO::PARAM_STR);

            $req->execute() or die(print_r($req->errorInfo(), TRUE));
        }
    }
?>