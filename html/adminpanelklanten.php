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
include_once("connection.php");
/**
 * @var PDO $pdo
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klanten Paneel</title>
</head>
<body>
    <h1>Klanten Paneel</h1>
    <a href="adminpanel.php">Terug naar Keuze Paneel</a>
<div>
    <h1>Welkom op het klantenpaneel van K3 Reizen!</h1>
</div>

<table>
    <thead>
        <tr>
            <th>id</th>
            <th>Voornaam</th>
            <th>Achternaam</th>
            <th>Geboortedatum</th>
            <th>Mailadres</th>
            <th>Gebruikersnaam</th>
            <th>Wachtwoord</th>
            <th>Verwijderen</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM Klanteninformatie"; // Ensure this is the correct table name
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>"
                . "<td>" . htmlspecialchars($result['id']) . "</td>"
                . "<td>" . htmlspecialchars($result['Voornaam']) . "</td>"
                . "<td>" . htmlspecialchars($result['Achternaam']) . "</td>"
                . "<td>" . htmlspecialchars($result['Geboortedatum']) . "</td>"
                . "<td>" . htmlspecialchars($result['Mailadres']) . "</td>"
                . "<td>" . htmlspecialchars($result['Gebruikersnaam']) . "</td>"
                . "<td>" . htmlspecialchars($result['Wachtwoord']) . "</td>"
                . "<td><a href=\"delete.php?id=" . htmlspecialchars($result['id']) . "&source=adminpanelklanten\" onclick=\"return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')\">Verwijderen</a></td>"
                . "</tr>";
        }
        ?>
    </tbody>
</table>
</body>
</html>
