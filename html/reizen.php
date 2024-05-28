<?php
 
include_once("header.php");

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php while ($result = $stmt->fetch()) {?>
        <div class="reis">
            <div class="reis-naam">
                <?= $result['Reisnaam']?>
            </div>
            <div class="reis-omschrijving">
                <?= $result['Omschrijving']?>
            </div>
            <div class="reis-land">
                <?= $result['Land']?>
            </div>
            <div class="reis-stad">
                <?= $result['Stad']?>
            </div>
            <div class="reis-prijs">
                <?= "€ ". $result['Prijs']?>
            </div>
            <div class="reis-duur">
                <?= $result['Duur']?>
            </div>
        </div>
    <?php }?>
</body>
</html>