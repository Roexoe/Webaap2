<?php
ob_start();
include_once('connection.php'); // Ensure the path is correct to your PDO connection file
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
<?php
// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Get the form data
    $reisnaam = $_POST['reisnaam'];
    $omschrijving = $_POST['omschrijving'];
    $land = $_POST['land'];
    $stad = $_POST['stad'];
    $prijs = $_POST['prijs'];
    $tijdsduur = $_POST['tijdsduur'];

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO Reizen (Reisnaam, Omschrijving, Land, Stad, Prijs, Tijdsduur) VALUES (:reisnaam, :omschrijving, :land, :stad, :prijs, :tijdsduur)";
    $stmt = $pdo->prepare($sql);
    
    // Execute the query
    if ($stmt->execute([
        ':reisnaam' => $reisnaam,
        ':omschrijving' => $omschrijving,
        ':land' => $land,
        ':stad' => $stad,
        ':prijs' => $prijs,
        ':tijdsduur' => $tijdsduur
    ])) {
        // Redirect back to the admin panel
        header('Location: adminpanelreizen.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $pdo->errorInfo()[2]; // Use $pdo->errorInfo() instead of $conn->error
        exit();
    }
}
?>

<!-- Form for adding a new reis -->
<form action="add.php" method="post">
    <label for="reisnaam">Reisnaam:</label>
    <input type="text" name="reisnaam" id="reisnaam" required><br>
    <label for="omschrijving">Omschrijving:</label>
    <textarea name="omschrijving" id="omschrijving" rows="4" cols="50" required></textarea><br>
    <label for="land">Land:</label>
    <input type="text" name="land" id="land" required><br>
    <label for="stad">Stad:</label>
    <input type="text" name="stad" id="stad" required><br>
    <label for="prijs">Prijs:</label>
    <input type="number" step="0.01" name="prijs" id="prijs" required><br>
    <label for="tijdsduur">Tijdsduur:</label>
    <input type="text" name="tijdsduur" id="tijdsduur" required><br>
    <input class="button" type="submit" name="submit" value="Opslaan" class="submit-button">
</form>
    
</body>
</html>
