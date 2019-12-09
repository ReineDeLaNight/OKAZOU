<?php
    $file = fopen('C:\Users\33781\Downloads\afficher.csv', 'r');
    $i = 0;
    $population = 0;
    while ($data[$i] = fgetcsv($file, 1024, ',')) {
        $i++;
        $population++;
    }

    $htmlTab = "<table BORDER>";

    for ($i = 0; $i < $population; $i++) {

        $htmlTab .= "<tr>";

        for ($j = 0; $j < sizeof($data[$i]); $j++) {
            $htmlTab .= "<td>".$data[$i][$j]."</td>";
        }

        $htmlTab .= "</tr>";
    }

    $htmlTab .= "</table>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CSV</title>
</head>
<body>
    <?php echo $htmlTab; ?>
</body>
</html>