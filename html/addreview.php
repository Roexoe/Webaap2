<?php
session_start();
/**
 * @var PDO $pdo
 */
include_once('connection.php');
if(isset($_POST['submit'])) {
    $voornaam = $_POST['Voornaam'];
    $achternaam = $_POST['Achternaam'];
    $email = $_POST['Email'];
    $telefoon = $_POST['Telefoonnummer'];
    $bericht = $_POST['Bericht'];
    $id = $_GET['id'];

    $sql = "INSERT INTO Review (Voornaam, Achternaam, Email, Telefoonnummer, Bericht, ReisID) VALUES (:voornaam, :achternaam, :email, :telefoon, :bericht, :id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':voornaam', $voornaam);
    $stmt->bindParam(':achternaam', $achternaam);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefoon', $telefoon);
    $stmt->bindParam(':bericht', $bericht);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
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
<!-- Formulier om een nieuwe review toe te voegen -->
<form action="addreview.php" method="post">
    <label for="Voornaam">Voornaam:</label>
    <input type="text" name="Voornaam" id="Voornaam" required><br>

    <label for="Achternaam">Achternaam:</label>
    <input type="text" name="Achternaam" id="Achternaam" required></input><br>

    <label for="Email">Email:</label>
    <input type="email" name="Email" id="Email" required><br>

    <label for="Telefoonnummer">Telefoonnummer:</label>
    <input type="text" name="Telefoonnummer" id="Telefoonnummer" required><br>

    <label for="Bericht">Bericht:</label>
    <input type="text" name="Bericht" id="Bericht" required><br>

    <input type="submit" name="submit" value="Opslaan" href="index.php" class="button">
</form>
</body>
</html>