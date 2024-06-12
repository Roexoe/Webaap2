<?php
session_start();

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
ob_start();
include_once('connection.php'); // Zorg ervoor dat het pad correct is naar je PDO-verbinding bestand

// Check of het formulier is verzonden
if (isset($_POST['submit'])) {
    // Ontvang de formuliergegevens
    $reisnaam = $_POST['reisnaam'];
    $omschrijving = $_POST['omschrijving'];
    $personen = $_POST['personen'];
    $stad = $_POST['stad'];
    $prijs = $_POST['prijs'];
    $tijdsduur = $_POST['tijdsduur'];
    $reisfoto = $_POST['reisfoto'];

    // Voorbereid en voer de SQL-query uit om de reis toe te voegen
    $sql = "INSERT INTO Reizen (Reisnaam, Omschrijving, Personen, Stad, Prijs, Tijdsduur, Reisfoto) VALUES (:reisnaam, :omschrijving, :personen, :stad, :prijs, :tijdsduur, :reisfoto)";
    $stmt = $pdo->prepare($sql);
    
    // Uitvoeren van de query
    if ($stmt->execute([
        ':reisnaam' => $reisnaam,
        ':omschrijving' => $omschrijving,
        ':personen' => $personen,
        ':stad' => $stad,
        ':prijs' => $prijs,
        ':tijdsduur' => $tijdsduur,
        ':reisfoto' => $reisfoto // Opslaan van het opgegeven relatieve pad
    ])) {
        // Terug naar het admin paneel na succesvolle toevoeging
        header('Location: adminpanelreizen.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $pdo->errorInfo()[2]; // Gebruik $pdo->errorInfo() in plaats van $conn->error
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styling/style.css">
    <title>Add Reis</title>
</head>
<body>
    <!-- Formulier om een nieuwe reis toe te voegen -->
    <form action="add.php" method="post">
        <label for="reisnaam">Reisnaam:</label>
        <input type="text" name="reisnaam" id="reisnaam" required><br>

        <label for="omschrijving">Omschrijving:</label>
        <textarea name="omschrijving" id="omschrijving" rows="4" cols="50" required></textarea><br>

        <label for="personen">Personen:</label>
        <input type="text" name="personen" id="personen" required><br>

        <label for="stad">Stad:</label>
        <input type="text" name="stad" id="stad" required><br>

        <label for="prijs">Prijs:</label>
        <input type="number" step="0.01" name="prijs" id="prijs" required><br>

        <label for="tijdsduur">Tijdsduur:</label>
        <input type="text" name="tijdsduur" id="tijdsduur" required><br>

        <label for="reisfoto">Relatief pad naar de foto:</label>
        <input type="text" name="reisfoto" id="reisfoto" required><br>

        <input type="submit" name="submit" value="Opslaan" class="button">
    </form>
</body>
</html>
