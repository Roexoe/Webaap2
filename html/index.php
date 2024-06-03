<?php
 
include_once("header.php");

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
        <button class="button">Boek nu je reis</button>
        </div>
    </div>
    <div class="titel">Vind jouw ideale reis</div>
    <div class="ideale-reis-container">
        <div class="menu-container">
        <?php if (!empty($results)): ?>
            <?php $counter = 0; ?>
            <?php foreach ($results as $result): ?>
                <?php if ($counter >= 3) break; ?>
                <div class="reisblok">
                    <div class="imgblok">
                        <div class="reisfoto"><?= htmlspecialchars($result['Reisfoto']) ?></div>
                    </div>
                    <div class="reisinfoblok">
                        <div class="reisnaam"><?= htmlspecialchars($result['Reisnaam']) ?></div>
                        <div class="reisomschrijving"><?= htmlspecialchars($result['Omschrijving']) ?></div>
                        <div class="reisland"><?= htmlspecialchars($result['Land']) ?></div>
                        <div class="reisstad"><?= htmlspecialchars($result['Stad']) ?></div>
                        <div class="reisprijs"><?= htmlspecialchars($result['Prijs']) ?></div>
                        <div class="reistijdsduur"><?= htmlspecialchars($result['Tijdsduur']) ?></div>
                    </div>
                </div>
                <?php $counter++; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Geen reizen gevonden.</p>
        <?php endif; ?>
        <button class="button">Kies uw reis</button>
    </div>
</div>
<div class="pagina-titelbox">
    <img src="img/contact-img.jpg" alt="oceaan">
        <div class="pagina-titel">
            Neem contact op met ons personeel
        <button class="button">Neem contact op</button>
        </div>
    </div>
<?php
 
 include_once("footer.php");
 
 ?>
</body>
</html>