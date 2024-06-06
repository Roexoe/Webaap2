<?php
include_once("connection.php");

// Start output buffering
ob_start();
include_once("header.php");

// Controleer of het formulier is ingediend
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ontvang de POST-gegevens
    $voornaam = $_POST['Voornaam'];
    $achternaam = $_POST['Achternaam'];
    $geboortedatum = $_POST['Geboortedatum'];
    $mailadres = $_POST['Mailadres'];
    $gebruikersnaam = $_POST['Gebruikersnaam'];
    $wachtwoord = $_POST['Wachtwoord'];

    try {
        // Bereid de SQL query voor
        $sql = "INSERT INTO Klanteninformatie (voornaam, achternaam, geboortedatum, mailadres, gebruikersnaam, wachtwoord) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$voornaam, $achternaam, $geboortedatum, $mailadres, $gebruikersnaam, $wachtwoord]);
        // Stop output buffering en stuur de headers
        ob_end_clean();
        header('Location: inlog.php');
        exit(); // Zorg ervoor dat het script stopt na het verzenden van de redirect
    } catch (PDOException $e) {
        echo "Fout: " . $e->getMessage();
    }
} else {
    // Stop output buffering en stuur de headers
    ob_end_flush();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registratie</title>
</head>
<body>
<div class="container">
  <img src="img/register-img.jpg" alt="register" class="background-image">
  <div class="text-over-image">
    <form class="form" name="register" action="register.php" method="post">
    <label>Register </label>
        <div>
            <div class="inputForm">
            <input type="text" class="input" placeholder="Voornaam" name="Voornaam" required>
            </div>
        </div>
        <div>
            <div class="inputForm">
            <input type="text" class="input" placeholder="Achternaam" name="Achternaam" required>
            </div>
        </div>
        <div>
            <div class="inputForm">
            <input type="date" class="input" placeholder="Geboortedatum" name="Geboortedatum" required>
            </div>
        </div>
        <div>
            <div class="inputForm">
            <input type="email" class="input" placeholder="Mailadres" name="Mailadres" required>
            </div>
        </div>
        <div>
            <div class="inputForm">
            <input type="text" class="input" placeholder="Gebruikersnaam" name="Gebruikersnaam" required>
            </div>
        </div>
        <div>
            <div class="inputForm">
            <input type="password" class="input" placeholder="Wachtwoord" name="Wachtwoord" required>
            </div>
        </div>
        <div>
        <input type="submit"class="button-submit" name="Register" value="Register">
        </div>
    </form>
</div>
<?php
include_once("footer.php");
?>
</body>
</html>
