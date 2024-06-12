<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Databaseverbinding initialiseren
include_once("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styling/style.css">
    <title>Petjet Reizen</title>
</head>
<body>
    <header>
        <nav>
            <div class="headerbox">
                <a href="index.php"><img class="logo" src="img/logo-pet-jet.png" alt="Logo"></a>
                <div class="header">
                    <a class="nav-item" href="overons.php">Over ons</a>
                    <a class="nav-item" href="reizen.php">Reizen</a>
                    <a class="nav-item" href="contact.php">Contact</a>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a class="nav-item" href="accountinfo.php">Mijn Account</a>
                        <a class="nav-item" href="logout.php">Logout</a>
                        <?php // Controleren of de gebruiker een admin is
                        $stmt = $pdo->prepare("SELECT admin FROM Klanteninformatie WHERE id = ?");
                        $stmt->execute([$_SESSION['user_id']]);
                        $admin = $stmt->fetchColumn();
                        if ($admin == 1): // Als de gebruiker een admin is
                        ?>
                            <a class="nav-item" href="adminpanel.php">Admin Panel</a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a class="nav-item" href="inlog.php">Login</a>
                    <?php endif; ?>
                </div>  
            </div>
        </nav>
    </header>
</body>
</html>
