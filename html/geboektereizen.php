<?php
// Include the connection.php file which includes the header.php file
include_once ("connection.php");
include_once("header.php")
?>

<h1>Geboekte Reizen</h1>
<a href="adminpanel.php">Terug naar Keuze Paneel</a>
<table border="1">
    <thead>
        <tr>
            <th>Geboekte reis</th>
            <th>Klant</th>
        </tr>
    </thead>
    <tbody>
        <?php
        try {
            // Query om geboekte reizen en bijbehorende klantinformatie op te halen
            $sql = "SELECT Reizen.Reisnaam, Reizen.Prijs, Klanteninformatie.Voornaam, Klanteninformatie.Achternaam
                    FROM Boekingen
                    INNER JOIN Reizen ON Boekingen.reisID = Reizen.id
                    INNER JOIN Klanteninformatie ON Boekingen.klantID = Klanteninformatie.id";

            $stmt = $pdo->query($sql);

            // Loop door de resultaten en toon ze in de tabelrijen
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row["Reisnaam"] . " - " . $row["Prijs"] . "</td>";
                echo "<td>" . $row["Voornaam"] . " " . $row["Achternaam"] . "</td>";
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
