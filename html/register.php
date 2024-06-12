<?php
session_start();
include_once("connection.php");
// Start output buffering
ob_start();
include_once("header.php");

function emailExists($mailadres) {
    global $pdo;
    $sql = "SELECT id FROM Klanteninformatie WHERE mailadres = :mailadres";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':mailadres', $mailadres, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user ? true : false;
}

// Controleer of het formulier is ingediend
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ontvang de POST-gegevens
    $voornaam = $_POST['Voornaam'];
    $achternaam = $_POST['Achternaam'];
    $geboortedatum = $_POST['Geboortedatum'];
    $mailadres = $_POST['Mailadres'];
    $gebruikersnaam = $_POST['Gebruikersnaam'];
    $wachtwoord = $_POST['Wachtwoord'];

    if (emailExists($mailadres)) {
        echo "<script>alert('Het opgegeven e-mailadres is al in gebruik. Kies een ander e-mailadres.');</script>";
    } else {
        try {
            // Bereid de SQL query voor
            $sql = "INSERT INTO Klanteninformatie (voornaam, achternaam, geboortedatum, mailadres, gebruikersnaam, wachtwoord, admin) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$voornaam, $achternaam, $geboortedatum, $mailadres, $gebruikersnaam, $wachtwoord, 0]);
            // Stop output buffering en stuur de headers
            ob_end_clean();
            header('Location: inlog.php');
            exit(); // Zorg ervoor dat het script stopt na het verzenden van de redirect
        } catch (PDOException $e) {
            echo "Fout: " . $e->getMessage();
        }
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
