<?php
include_once("connection.php");
include_once("header.php");

/**
 * @var PDO $pdo
 */

// Controleer of er een zoekopdracht is ingediend
if (isset($_GET['query'])) {
    // Zoekopdracht uitvoeren
    $query = '%' . $_GET['query'] . '%';
    $sql = "SELECT id, Reisnaam, Omschrijving, Personen, Stad, Prijs, Tijdsduur FROM Reizen WHERE Reisnaam LIKE :query_reisnaam OR Omschrijving LIKE :query_omschrijving OR Personen LIKE :query_Personen OR Stad LIKE :query_stad";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':query_reisnaam', $query, PDO::PARAM_STR);
    $stmt->bindParam(':query_omschrijving', $query, PDO::PARAM_STR);
    $stmt->bindParam(':query_Personen', $query, PDO::PARAM_STR);
    $stmt->bindParam(':query_stad', $query, PDO::PARAM_STR);

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Geen zoekopdracht, haal alle reizen op
    $sql = "SELECT id, Reisnaam, Omschrijving, Personen, Stad, Prijs, Tijdsduur FROM Reizen";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styling/style.css">
    <title>Reizen</title>
</head>
<body>
    <form action="reizen.php" method="get">
        <input type="text" name="query" placeholder="Zoek een reis...">
        <input type="submit" value="Zoek">
    </form>
    <div class="menu-container">
        <?php if (!empty($results)): ?>
            <?php foreach ($results as $result): ?>
                <div class="reisblok">
                    <div class="reisnaam"><?= htmlspecialchars($result['Reisnaam']) ?></div>
                    <div class="reisomschrijving"><?= htmlspecialchars($result['Omschrijving']) ?></div>
                    <div class="reisPersonen"><?= htmlspecialchars($result['Personen']) ?></div>
                    <div class="reisstad"><?= htmlspecialchars($result['Stad']) ?></div>
                    <div class="reisprijs"><?= htmlspecialchars($result['Prijs']) ?></div>
                    <div class="reistijdsduur"><?= htmlspecialchars($result['Tijdsduur']) ?></div>
                    <a href="boek.php?id=<?= $result['id'] ?>" class="boek-knop">Boek</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Geen reizen gevonden.</p>
        <?php endif; ?>
    </div>
</body>
</html>
