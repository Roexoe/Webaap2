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
    <h1>Admin panel Pet Jet</h1>
    <h2>Choose an Option:</h2>
    <ul>
        <li><a href="adminpanelklanten.php">Klanten Paneel</a></li>
        <li><a href="adminpanelreizen.php">Reizen Paneel</a></li>
        <li><a href="geboektereizen.php">Geboekte reizen</a></li>
    </ul>
</body>
</html>