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
    <title>Reizen Paneel</title>
</head>
<body>
    <div class="margin"></div>
    <div class="margin"></div>
    <h1>Reizen Paneel</h1>
    <a href="adminpanel.php">Terug naar Keuze Paneel</a>
<div>
    <button class="button" type="button" onclick="location.href='add.php';">Voeg een Reis toe</button>
    <h1>Welkom op het admin paneel van K3 Reizen !</h1>
</div>

<table>
    <thead>
        <tr>
            <th>id</th>
            <th>Reisnaam</th>
            <th>Omschrijving</th>
            <th>Personen</th>
            <th>Stad</th>
            <th>Prijs</th>
            <th>Tijdsduur</th>
            <th>Bewerken</th>
            <th>Verwijderen</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM Reizen";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        while ($result = $stmt->fetch()) {
            echo "<tr>"
                . "<td>" . $result['id'] . "</td>"
                . "<td>" . $result['Reisnaam'] . "</td>"
                . "<td>" . $result['Omschrijving'] . "</td>"
                . "<td>" . $result['Personen'] . "</td>"
                . "<td>" . $result['Stad'] . "</td>"
                . "<td>" . $result['Prijs'] . "</td>"
                . "<td>" . $result['Tijdsduur'] . "</td>"
                . "<td><a href='edit.php?id=" . $result['id'] . "'>Bewerken</a></td>"
                . "<td><a href='delete.php?id=" . $result['id'] . "' onclick=\"return confirm('Weet je zeker dat je deze reis wilt verwijderen?')\">Verwijderen</a></td>"
                . "</tr>";
        }
        ?>
    </tbody>
</table>
</body>
</html>
