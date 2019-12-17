<?php
    $fichier = $fichier = "vinted";
    $file = fopen("C:\Users\33781\Downloads\afficher.csv", "r");
    $categorie = [
        "femmes",
        "hommes",
        "enfants"
    ];

    $categorie_femme = [
        "Sweats et sweats à capuche",
        "Robes",
        "Hauts & Tee-shirts",
        "Pantalons & leggings",
        "Combinaisons & combishorts",
        "Lingerie & pyjamas",
        "Vêtements de sport",
        "Manteaux & vestes",
        "Blazers &  tailleurs",
        "Jupes",
        "Jeans",
        "Shorts";
        "Maillots de bain",
        "Maternité",
        "Costumes & tenues particulières"
    ];

    $categorie_enfant = [
        "Filles",
        "Jeux & Jouets",
        "Poussettes",
        "Garçons",
        
    ];

    for ($i = 0; $i < sizeof($categorie); $i++) {
        parcourir_categorie($categorie[$i]);
    }

    function parcourir_categorie($categorie) {

    }
?>