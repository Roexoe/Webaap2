<?php
session_start();
include_once("connection.php");
include_once("header.php");
/**
 * @var PDO $pdo
 */
// Controleer of een reis-ID is opgegeven
if (isset($_GET['id'])) {
    $reisId = $_GET['id'];
    // Haal reisgegevens op
    $sql = "SELECT Reisnaam, Omschrijving, Personen, Stad, Prijs, Tijdsduur, reisfoto FROM Reizen WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $reisId, PDO::PARAM_INT);
    $stmt->execute();
    $reis = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$reis) {
        die("Reis niet gevonden.");
    }
} else {
    die("Geen reis-ID opgegeven.");
}
// Controleer of het formulier is ingediend
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $voornaam = $_POST['Voornaam'];
    $achternaam = $_POST['Achternaam'];
    $mailadres = $_POST['Mailadres'];
    $geboortedatum = $_POST['Geboortedatum'];
    $vertrekdatum = $_POST['Vertrekdatum'];
    $terugkomstdatum = $_POST['Terugkomstdatum'];
    $gebruikersnaam = $_POST['Gebruikersnaam'];
    $wachtwoord = $_POST['Wachtwoord'];
    // Voeg hier de verwerking van het formulier toe, bijvoorbeeld het opslaan van de gegevens in de database
    // Hieronder een voorbeeld van hoe je de gegevens zou kunnen verwerken
    try {
        // Controleer eerst of de klant al bestaat in de Klanteninformatie tabel
        $sql = "SELECT id FROM Klanteninformatie WHERE Mailadres = :mailadres AND Geboortedatum = :geboortedatum AND Gebruikersnaam = :gebruikersnaam AND Wachtwoord = :wachtwoord";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':mailadres', $mailadres, PDO::PARAM_STR);
        $stmt->bindParam(':geboortedatum', $geboortedatum, PDO::PARAM_STR);
        $stmt->bindParam(':gebruikersnaam', $gebruikersnaam, PDO::PARAM_STR);
        $stmt->bindParam(':wachtwoord', $wachtwoord, PDO::PARAM_STR);
        $stmt->execute();
        $klant = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$klant) {
            // De klant bestaat niet, stuur de gebruiker door naar het registratiepagina
            echo "<script>alert('Je hebt volgens ons systeem nog geen account. Je wordt doorverwezen naar het registratieformulier.'); window.location.href='register.php';</script>"; 
            exit(); // Zorg ervoor dat het script hier stopt na de doorverwijzing
        } else {
            $klantId = $klant['id'];
        }
        // Voeg boeking toe aan de Boekingen tabel
        $sql = "INSERT INTO Boekingen (reisID, klantID, vertrekdatum, terugkomstdatum) 
                VALUES (:reisID, :klantID, :vertrekdatum, :terugkomstdatum)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':reisID', $reisId, PDO::PARAM_INT);
        $stmt->bindParam(':klantID', $klantId, PDO::PARAM_INT);
        $stmt->bindParam(':vertrekdatum', $vertrekdatum, PDO::PARAM_STR);
        $stmt->bindParam(':terugkomstdatum', $terugkomstdatum, PDO::PARAM_STR);
        $stmt->execute();
        echo "Boeking succesvol!";
    } catch (PDOException $e) {
        echo "Er is een fout opgetreden bij het boeken: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styling/style.css">
    <title>Boek een Reis</title>
</head>
<body>
    <h1>Boek <?= htmlspecialchars($reis['Reisnaam']) ?></h1>
    <img src="<?= htmlspecialchars($reis['reisfoto']) ?>" alt="Reis foto">
    <p><?= htmlspecialchars($reis['Omschrijving']) ?></p>
    <p>Aantal personen: <?= htmlspecialchars($reis['Personen']) ?></p>
    <p>Stad: <?= htmlspecialchars($reis['Stad']) ?></p>
    <p>Prijs: <?= htmlspecialchars('€' . $reis['Prijs']) ?></p>
    <p>Tijdsduur: <?= htmlspecialchars($reis['Tijdsduur'] . ' dagen') ?></p>
    <form action="" method="post">
        <input type="hidden" name="reis_id" value="<?= htmlspecialchars($reisId) ?>">
        <label for="voornaam">Voornaam:</label>
        <input type="text" id="voornaam" name="Voornaam" required>
        <label for="achternaam">Achternaam:</label>
        <input type="text" id="achternaam" name="Achternaam" required>
        <label for="mailadres">Mailadres:</label>
        <input type="email" id="mailadres" name="Mailadres" required>
        <label for="geboortedatum">Geboortedatum:</label>
        <input type="date" id="geboortedatum" name="Geboortedatum" required>
        <label for="Vertrekdatum">Vertrekdatum:</label>
        <input type="date" id="Vertrekdatum" name="Vertrekdatum" required>
        <label for="Terugkomstdatum">Terugkomstdatum:</label>
        <input type="date" id="Terugkomstdatum" name="Terugkomstdatum" required>
        <label for="gebruikersnaam">Gebruikersnaam:</label>
        <input type="text" id="gebruikersnaam" name="Gebruikersnaam" required>
        <label for="wachtwoord">Wachtwoord:</label>
        <input type="password" id="wachtwoord" name="Wachtwoord" required>
        <input type="submit" value="Boek">
    </form>
    <form action="addreview.php" method="get">
        <input type="hidden" name="ReisID" value="<?= htmlspecialchars($reisId); ?>">
        <button type="submit">Laat een review achter</button>
    </form>
    <?php
// Controleer of er een reis-ID is
if (isset($reisId)) {
    // SQL-query om reviews op te halen
    $sql = "SELECT Voornaam, Achternaam, Email, Telefoonnummer, Bericht FROM Review WHERE ReisID = :reisID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':reisID', $reisId, PDO::PARAM_INT);
    $stmt->execute();
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($reviews) {
        echo "<h2>Reviews</h2>";
        foreach ($reviews as $review) {
            echo "<div class='review'>";
            echo "<h3>Naam: " . htmlspecialchars($review['Voornaam']) . " " . htmlspecialchars($review['Achternaam']) . "</h3>";
            echo "<p><strong>Review</strong> " . htmlspecialchars($review['Bericht']) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>Er zijn nog geen reviews voor deze reis.</p>";
    }
}
?>
    <script>
    window.onload = function() {
        var vertrekdatum = document.getElementById('Vertrekdatum');
        var terugkomstdatum = document.getElementById('Terugkomstdatum');
        var tijdsduur = <?= $reis['Tijdsduur'] ?>; // Haal de tijdsduur uit de PHP variabele
        // Zet de minimale vertrekdatum op 2 weken vanaf vandaag
        var vandaag = new Date();
        var minVertrekdatum = new Date();
        minVertrekdatum.setDate(vandaag.getDate() + 14);
        vertrekdatum.min = minVertrekdatum.toISOString().split('T')[0];
        // Wanneer de vertrekdatum verandert, stel de terugkomstdatum in op de vertrekdatum plus de tijdsduur
        vertrekdatum.onchange = function() {
            var vertrek = new Date(vertrekdatum.value);
            var terugkomst = new Date(vertrek);
            terugkomst.setDate(vertrek.getDate() + tijdsduur);
            terugkomstdatum.value = terugkomst.toISOString().split('T')[0];
        };
    };
    </script>
</body>
</html>