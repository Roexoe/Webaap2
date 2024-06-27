<?php
session_start();
include_once('connection.php');

// Haal ReisID op uit de URL
$reisID = isset($_GET['ReisID']) ? $_GET['ReisID'] : null;

if(isset($_POST['submit'])) {
    $voornaam = $_POST['Voornaam'];
    $achternaam = $_POST['Achternaam'];
    $email = $_POST['Email'];
    $telefoon = $_POST['Telefoonnummer'];
    $bericht = $_POST['Bericht'];
    // Gebruik de ReisID die is opgehaald uit de URL
    if($reisID !== null) {
        $sql = "INSERT INTO Review (Voornaam, Achternaam, Email, Telefoonnummer, Bericht, ReisID) VALUES (:voornaam, :achternaam, :email, :telefoon, :bericht, :reisID)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':voornaam', $voornaam);
        $stmt->bindParam(':achternaam', $achternaam);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefoon', $telefoon);
        $stmt->bindParam(':bericht', $bericht);
        $stmt->bindParam(':reisID', $reisID);
        $stmt->execute();
    } else {
        echo "ReisID is niet opgegeven.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styling/style.css">
    <title>Add Review</title>
</head>
<body>
<!-- Formulier om een nieuwe review toe te voegen, nu met ReisID -->
<form action="addreview.php?ReisID=<?php echo htmlspecialchars($reisID); ?>" method="post">
    <label for="Voornaam">Voornaam:</label>
    <input type="text" name="Voornaam" id="Voornaam" required><br>
    <label for="Achternaam">Achternaam:</label>
    <input type="text" name="Achternaam" id="Achternaam" required><br>
    <label for="Email">Email:</label>
    <input type="email" name="Email" id="Email" required><br>
    <label for="Telefoonnummer">Telefoonnummer:</label>
    <input type="text" name="Telefoonnummer" id="Telefoonnummer" required><br>
    <label for="Bericht">Bericht:</label>
    <input type="text" name="Bericht" id="Bericht" required><br>
    <!-- Verborgen veld voor ReisID -->
    <input type="hidden" name="ReisID" value="<?php echo htmlspecialchars($reisID); ?>">
    <input type="submit" name="submit" value="Opslaan" class="button">
    <a href="boek.php?id=<?php echo htmlspecialchars($reisID); ?>">Terug naar de reis</a>
</form>
</body>
</html>