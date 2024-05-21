<?php
ob_start(); 
include_once("header.php");

session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styling/style.css">
    <title>K3 Reizen inlogpagina</title>
</head>
<body>

<form name="login" action="inlog.php" method="post">
    <div>
    <input type="text" name="username" placeholder="username">
</div>
<div>
    <input type="password" name="password" placeholder="password">
    <div class="header-options">
    <input type="submit" name="inloggen" value="Inloggen">
    <div>
</form>

<?php

if (isset($_POST['inloggen'])) {
    // Check if the username and password are set
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Replace 'your_username' and 'your_password' with the actual username and password you want to check
        $valid_username = 'Admin';
        $valid_password = 'Admin@';

        // Retrieve the submitted username and password
        $submitted_username = $_POST['username'];
        $submitted_password = $_POST['password'];

        // Check if the submitted username and password match the valid ones
        if ($submitted_username === $valid_username && $submitted_password === $valid_password) {
            // Set a session variable to indicate that the user is logged in
            $_SESSION['username'] = $submitted_username;
            echo "Login successful!";
            // Redirect to admin.php
            header('Location: adminpanel.php');
            exit;
        } else {
            echo "Invalid username or password";
        }
    } else {
        echo "Please enter both username and password";
    }
}

// Send the buffered output to the browser
ob_end_flush();
?>

</body>
</html>