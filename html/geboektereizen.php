<?php
include_once("connection.php");
include_once("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geboekte Reizen</title>
</head>
<body>
<h1>Geboekte Reizen</h1>
<a href="adminpanel.php">Terug naar Keuze Paneel</a>
<table border="1">
    <thead>
        <tr>
            <th>Reisnaam</th>
            <th>Prijs</th>
            <th>Vertrekdatum</th>
            <th>Terugkomstdatum</th>
            <th>Voornaam</th>
            <th>Achternaam</th>
            <th>Mailadres</th>
        </tr>
    </thead>
    <tbody>
        <?php
        try {
            // Query om geboekte reizen en bijbehorende klantinformatie op te halen
            $sql = "SELECT Reizen.Reisnaam, Reizen.Prijs, Boekingen.vertrekdatum, Boekingen.terugkomstdatum, Klanteninformatie.Voornaam, Klanteninformatie.Achternaam, Klanteninformatie.Mailadres
                    FROM Boekingen
                    INNER JOIN Reizen ON Boekingen.reisID = Reizen.id
                    INNER JOIN Klanteninformatie ON Boekingen.klantID = Klanteninformatie.id";
            $stmt = $pdo->query($sql);

            // Loop door de resultaten en toon ze in de tabelrijen
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["Reisnaam"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["Prijs"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["vertrekdatum"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["terugkomstdatum"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["Voornaam"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["Achternaam"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["Mailadres"]) . "</td>";
                echo "</tr>";
            }
        } catch (PDOException $e) {
            echo "Fout: " . $e->getMessage();
        }
        ?>
    </tbody>
</table>
</body>
</html>
