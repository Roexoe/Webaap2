<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klanten Paneel</title>
</head>
<body>
    <h1>Geboekte Reizen</h1>
    <a href="adminpanel.php">Terug naar Keuze Paneel</a>
</div>
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
                // Verbinding maken met de database
                $host = '172.18.0.2';
                $db   = 'Klanteninformatie';
                $user = 'root';
                $pass = 'rootpassword';
                $charset = 'utf8mb4';

                $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];
                $pdo = new PDO($dsn, $user, $pass, $options);

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
