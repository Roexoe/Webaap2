<?php
session_start();
?>

<?php
include_once("connection.php");
include_once("header.php");
/**
 * @var PDO $pdo
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reizen</title>
    <link rel="stylesheet" type="text/css" href="../styling/style.css">
</head>
<body>
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
            <th>Wachtwoord (gehasht)</th>
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
                . "<td>" . htmlspecialchars(password_hash($result['Wachtwoord'], PASSWORD_DEFAULT)) . "</td>"
                . "<td><a href=\"delete.php?id=" . htmlspecialchars($result['id']) . "&source=adminpanelklanten\" onclick=\"return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')\">Verwijderen</a></td>"
                . "</tr>";
        }
        ?>
    </tbody>
</table>
</body>
</html>
