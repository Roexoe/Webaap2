<?php
session_start();

include_once("header.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
    <div class="margin"></div>
    <div class="margin"></div>
    <div class="titel">Admin panel Pet Jet</div>
    <div class="titel">Choose an Option:</div>
    <div class="panel-box">
        <a class="button-submit-panel" href="adminpanelklanten.php">Klanten Paneel</a>
        <a class="button-submit-panel"href="adminpanelreizen.php">Reizen Paneel</a>
        <a class="button-submit-panel" href="geboektereizen.php">Geboekte reizen</a>
    </div>
</body>
</html>