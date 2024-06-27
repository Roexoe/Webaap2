<?php
session_start();

include_once("connection.php");
include_once("header.php");

/**
 * @var PDO $pdo
 */

// Controleer of er een zoekopdracht is ingediend
if (isset($_GET['query'])) {
    // Zoekopdracht uitvoeren
    $query = '%' . $_GET['query'] . '%';
    $sql = "SELECT id, Reisnaam, Omschrijving, Personen, Stad, Prijs, Tijdsduur, reisfoto FROM Reizen WHERE Reisnaam LIKE :query_reisnaam OR Omschrijving LIKE :query_omschrijving OR Personen LIKE :query_Personen OR Stad LIKE :query_stad";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':query_reisnaam', $query, PDO::PARAM_STR);
    $stmt->bindParam(':query_omschrijving', $query, PDO::PARAM_STR);
    $stmt->bindParam(':query_Personen', $query, PDO::PARAM_STR);
    $stmt->bindParam(':query_stad', $query, PDO::PARAM_STR);

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Geen zoekopdracht, haal alle reizen op
    $sql = "SELECT id, Reisnaam, Omschrijving, Personen, Stad, Prijs, Tijdsduur, reisfoto FROM Reizen";
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
<div class="reizenblok">
    <form action="reizen.php" method="get">
        <input class="zoekbalk" type="text" name="query" placeholder="Zoek een reis...">
        <input class="button" type="submit" value="Zoek">
    </form>
    <div class="menu-container-1">
        <?php if (!empty($results)): ?>
            <?php foreach ($results as $result): ?>
                <div class="reisblok">
                    <div class="imgblok-reizen">
                        <?php if (!empty($result['reisfoto'])): ?>
                            <img width="400" src="<?= htmlspecialchars($result['reisfoto']) ?>" alt="reisfoto">
                        <?php endif; ?>
                    </div>
                    <div class="reisinfoblok">
                        <div class="details">
                            <div class="features">
                                <div class="feature">
                                    <div class="checkmark"></div>
                                    <div class="reisnaam"><?= htmlspecialchars($result['Reisnaam']) ?></div>
                                </div>
                                <div class="feature">
                                    <div class="checkmark"></div>
                                    <div class="reisland"><?= htmlspecialchars($result['Personen'] . ' Personen') ?></div>
                                </div>
                                <div class="feature">
                                    <div class="checkmark"></div>
                                    <div class="reisprijs"><?= htmlspecialchars('€' . $result['Prijs']) ?></div>
                                </div>
                                <div class="feature">
                                    <div class="checkmark"></div>
                                    <div class="reistijdsduur"><?= htmlspecialchars($result['Tijdsduur'] . ' Dagen') ?></div>
                                </div>
                            </div>
                            <div class="book-now">
                                <a href="boek.php?id=<?= $result['id'] ?>" class="button">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Geen reizen gevonden.</p>
        <?php endif; ?>
    </div>
</div>
<?php
include_once("footer.php");
?>
</body>
</html>