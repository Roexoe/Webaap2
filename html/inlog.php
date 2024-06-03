<?php
ob_start();
include_once("header.php");
session_start();
require_once 'connection.php';

$login_error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['inloggen'])) {
    $gebruikersnaam = $_POST['username'];
    $wachtwoord = $_POST['password'];

    try {
        $sql = "SELECT * FROM Klanteninformatie WHERE Gebruikersnaam = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$gebruikersnaam]);
        $user = $stmt->fetch();

        if ($user && $wachtwoord === $user['Wachtwoord']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['Gebruikersnaam'];
            header('Location: index.php');
            exit();
        } else {
            $login_error = "Ongeldige gebruikersnaam of wachtwoord.";
        }
    } catch (PDOException $e) {
        echo "Fout: " . $e->getMessage();
    }
}

ob_end_flush();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styling/style.css">
    <title>K3 Reizen inlogpagina</title>
</head>
<body>

<?php include 'cookie.php';?>

<!-- Include the JavaScript file -->
<script src="cookie.js"></script>

<form name="login" action="inlog.php" method="post">
    <div>
        <input type="text" name="username" placeholder="Gebruikersnaam" required>
    </div>
    <div>
        <input type="password" name="password" placeholder="Wachtwoord" required>
    </div>
    <div class="header-options">
        <input type="submit" name="inloggen" value="Inloggen">
    </div>
    <?php if ($login_error): ?>
        <div style="color: red;">
            <?php echo $login_error; ?>
        </div>
    <?php endif; ?>
</form>

<p> <a href="register.php">Ik heb nog geen account.</a> </p>

</body>
</html>
