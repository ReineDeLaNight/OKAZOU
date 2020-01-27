<?php
function regex_all($page_start, $page_end, $categorie) {
    
    $page = $page_start;
    while ($page <= $page_end) {
        $handle = curl_init();
        
        $url = "https://www.onceagain.fr/collections/$categorie?page=$page";
        echo "$url<br>";
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

        echo $output;

        //$regex = preg_match_all('%itemprop="brand">[a-zA-Z]+%', $output, $matches); // marque
        $regex = preg_match_all('%itemprop="url" target="_self" href="[a-zA-Z0-9-_\.\/?=&]+%', $output, $matches); // url article
       
        //print_r(curl_getinfo($handle));
        curl_close($handle);

    }
           
}

$page_start = 1;
$page_end = 1;
$categorie = [
    "vetements-occasion-femme",
    "friperie-en-ligne-homme"
]   ;

for ($i = 0; $i < sizeof($categorie); $i++) {
    $data = regex_all($page_start, $page_end, $categorie[$i]);
}
//print_r($data);


?>