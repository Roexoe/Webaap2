<?php
session_start();
include_once("connection.php");
include_once("header.php");

$klantID = $_SESSION['user_id'];

try {
    // Query om accountgegevens van de ingelogde klant op te halen
    $sqlAccount = "SELECT Voornaam, Achternaam, Geboortedatum, Mailadres, Gebruikersnaam FROM Klanteninformatie WHERE id = :id";
    $stmtAccount = $pdo->prepare($sqlAccount);
    $stmtAccount->bindParam(':id', $klantID, PDO::PARAM_INT);
    $stmtAccount->execute();
    $gebruiker = $stmtAccount->fetch(PDO::FETCH_ASSOC);

    if (!$gebruiker) {
        die("Gebruiker niet gevonden.");
    }

    // Query om geboekte reizen van de ingelogde klant op te halen
    $sqlReizen = "SELECT Reizen.Reisnaam, Reizen.Prijs, Boekingen.vertrekdatum, Boekingen.terugkomstdatum
                  FROM Boekingen
                  INNER JOIN Reizen ON Boekingen.reisID = Reizen.id
                  WHERE Boekingen.klantID = :klantID";
    $stmtReizen = $pdo->prepare($sqlReizen);
    $stmtReizen->bindParam(':klantID', $klantID, PDO::PARAM_INT);
    $stmtReizen->execute();
    $geboekteReizen = $stmtReizen->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Fout: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styling/style.css">
    <title>Mijn Account</title>
</head>
<body>
    <h1>Mijn Account</h1>
    <p><strong>Voornaam:</strong> <?= htmlspecialchars($gebruiker['Voornaam']) ?></p>
    <p><strong>Achternaam:</strong> <?= htmlspecialchars($gebruiker['Achternaam']) ?></p>
    <p><strong>Geboortedatum:</strong> <?= htmlspecialchars($gebruiker['Geboortedatum']) ?></p>
    <p><strong>Mailadres:</strong> <?= htmlspecialchars($gebruiker['Mailadres']) ?></p>
    <p><strong>Gebruikersnaam:</strong> <?= htmlspecialchars($gebruiker['Gebruikersnaam']) ?></p>
    <a href="logout.php">Uitloggen</a>

    <h2>Geboekte Reizen</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Reisnaam</th>
                <th>Prijs</th>
                <th>Vertrekdatum</th>
                <th>Terugkomstdatum</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($geboekteReizen as $reis): ?>
                <tr>
                    <td><?= htmlspecialchars($reis['Reisnaam']) ?></td>
                    <td><?= htmlspecialchars($reis['Prijs']) ?></td>
                    <td><?= htmlspecialchars($reis['vertrekdatum']) ?></td>
                    <td><?= htmlspecialchars($reis['terugkomstdatum']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
