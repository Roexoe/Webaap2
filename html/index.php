<?php
session_start();
include_once("connection.php");
include_once("header.php");
?>
<?php
// Query om reizen op te halen
$sql = "SELECT * FROM Reizen"; // Tabelnaam aanpassen
$stmt = $pdo->query($sql);

// Controleer of er resultaten zijn
if ($stmt->rowCount() > 0) {
    // Resultaten toewijzen aan de variabele $results
    $results = $stmt->fetchAll();
} else {
    // Als er geen resultaten zijn, initialiseer $results als een lege array
    $results = array();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petjet Reizen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="pagina-titelbox">
        <img src="img/Island_Heart.jpg" alt="Eiland">
        <div class="pagina-titel">
            Ontdek onze Wereld
            <button class="button" onclick="window.location.href='reizen.php'">Boek nu je reis</button>
        </div>
    </div>

    <div class="ideale-reis-container">
        <div class="titel">Vind jouw ideale reis</div>
        <div class="menu-container">
            <?php if (!empty($results)): ?>
                <?php $counter = 0; ?>
                <?php foreach ($results as $result): ?>
                    <?php if ($counter >= 3) break; ?>
                    <div class="reisblok">
                        <div class="imgblok">
                            <?php if (!empty($result['reisfoto'])): ?>
                                <img width="500" src="<?= htmlspecialchars($result['reisfoto']) ?>" alt="Reisfoto">
                            <?php endif; ?>
                            <div class="reisinfoblok">
                                <div class="reisnaam"><?= htmlspecialchars($result['Reisnaam']) ?></div>
                                <div class="reisomschrijving"><?= htmlspecialchars($result['Omschrijving']) ?></div>
                                <div class="reisland"><?= htmlspecialchars($result['Personen']. ' personen') ?></div>
                                <div class="reisstad"><?= htmlspecialchars($result['Stad']) ?></div>
                                <div class="reisprijs"><?= htmlspecialchars('€' . $result['Prijs']) ?></div>
                                <div class="reistijdsduur"><?= htmlspecialchars($result['Tijdsduur'] . ' dagen') ?></div>
                            </div>
                        </div>
                    </div>
                    <?php $counter++; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Geen reizen gevonden.</p>
            <?php endif; ?>
            <button class="button" onclick="window.location.href='reizen.php'">Kies uw reis</button>
        </div>
    </div>

    <div class="pagina-titelbox">
        <img src="img/contact-img.jpg" alt="oceaan">
        <div class="pagina-titel">
            Neem contact op met ons personeel
            <button class="button" onclick="window.location.href='contact.php'">Neem contact op</button>
        </div>
    </div>

    <?php include_once("footer.php"); ?>
</body>
</html>
