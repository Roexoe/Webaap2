<?php
session_start();

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    header('Location: inlog.php');
    exit();
}

// Controleer of de gebruiker een admin is
if (!$_SESSION['admin']) {
    header('Location: index.php');  // of waar je ook niet-admins wilt omleiden
    exit();
}

include_once("header.php"); 
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