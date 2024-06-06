<?php
session_start();
ob_start();
include_once("header.php");
require_once ("connection.php");

$login_error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['inloggen'])) {
    $gebruikersnaam = $_POST['username'];
    $wachtwoord = $_POST['password'];

    try {
        $sql = "SELECT * FROM Klanteninformatie WHERE Gebruikersnaam = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$gebruikersnaam]);
        $user = $stmt->fetch();

        if ($user && $wachtwoord === $user['Wachtwoord']) {  // Voor productie, gebruik wachtwoord hashing en verificatie
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

<!--<//?php include 'cookie.php';?>-->

<!-- Include the JavaScript file -->
<!--<script src="cookie.js"></script>-->

<div class="container">
  <img src="img/inlog-img.jpg" alt="inlog" class="background-image">
  <div class="text-over-image">
  <div class="inlog-box">
    <form class="form" name="login" action="inlog.php" method="post">
    <div class="flex-column">
    <label>Email </label></div>
    <div class="inputForm">
    <input type="text" class="input" type="password" name="password" placeholder="Wachtwoord" required>
    </div>
    <div class="flex-column">
    <label>Password </label></div>
    <div class="inputForm">
    <input type="password" class="input" placeholder="Wachtwoord">
    </div>
    <div class="flex-row">
    
    <p> <a class="geen-account" href="register.php">Ik heb nog geen account.</a> </p>
    <p> <a class="geen-account" href="vergeten.php">Wachtwoord vergeten.</a> </p>
    </div>
    <input type="submit" class="button-submit" name="inloggen" value="Inloggen">
    <?php if ($login_error): ?>
        <div style="color: red;">
            <?php echo $login_error; ?>
        </div>
    <?php endif; ?>
    </form>
</div>
</div>
</div>
<?php
include_once("footer.php");
?>


</body>
</html>
