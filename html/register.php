<?php
require_once 'connection.php';

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
        
        header('Location: inlog.php');

        exit(); // Zorg ervoor dat het script stopt na het verzenden van de redirect
    } catch (PDOException $e) {
        echo "Fout: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registratie</title>
</head>
<body>
    <form action="register.php" method="post">
        <div>
            <label>Voornaam:</label>
            <input type="text" name="Voornaam" required>
        </div>
        <div>
            <label>Achternaam:</label>
            <input type="text" name="Achternaam" required>
        </div>
        <div>
            <label>Geboortedatum:</label>
            <input type="date" name="Geboortedatum" required>
        </div>
        <div>
            <label>Mailadres:</label>
            <input type="email" name="Mailadres" required>
        </div>
        <div>
            <label>Gebruikersnaam:</label>
            <input type="text" name="Gebruikersnaam" required>
        </div>
        <div>
            <label>Wachtwoord:</label>
            <input type="password" name="Wachtwoord" required>
        </div>
        <div>
            <button type="submit">Registreer</button>
        </div>
    </form>
</body>
</html>