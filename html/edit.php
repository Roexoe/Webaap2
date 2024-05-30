<?php
session_start();
require_once('connection.php'); // Ensure connection.php is the correct path to your PDO connection file

/**
 * @var PDO $pdo
 */

$id = isset($_GET['id']) ? $_GET['id'] : '';

$sql = "SELECT * FROM Reizen WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "UPDATE Reizen SET Reisnaam = :Reisnaam, Omschrijving = :Omschrijving, Land = :Land, Stad = :Stad, Prijs = :Prijs, Tijdsduur = :Tijdsduur WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':Reisnaam', $_POST['Reisnaam']);
    $stmt->bindParam(':Omschrijving', $_POST['Omschrijving']);
    $stmt->bindParam(':Land', $_POST['Land']);
    $stmt->bindParam(':Stad', $_POST['Stad']);
    $stmt->bindParam(':Prijs', $_POST['Prijs']);
    $stmt->bindParam(':Tijdsduur', $_POST['Tijdsduur']);

    $stmt->execute();

    header('Location: adminpanelreizen.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styling/style.css">
    <title>Edit Reis</title>
</head>
<body>
    <form method="post" action="edit.php?id=<?php echo htmlspecialchars($id); ?>">
        <label for="Reisnaam">Reisnaam:</label>
        <input type="text" name="Reisnaam" id="Reisnaam" value="<?php echo htmlspecialchars($result['Reisnaam']); ?>" required>

        <label for="Omschrijving">Omschrijving:</label>
        <textarea name="Omschrijving" id="Omschrijving" required><?php echo htmlspecialchars($result['Omschrijving']); ?></textarea>

        <label for="Land">Land:</label>
        <input type="text" name="Land" id="Land" value="<?php echo htmlspecialchars($result['Land']); ?>" required>

        <label for="Stad">Stad:</label>
        <input type="text" name="Stad" id="Stad" value="<?php echo htmlspecialchars($result['Stad']); ?>" required>

        <label for="Prijs">Prijs:</label>
        <input type="number" name="Prijs" id="Prijs" step="0.01" value="<?php echo htmlspecialchars($result['Prijs']); ?>" required>

        <label for="Tijdsduur">Tijdsduur:</label>
        <input type="text" name="Tijdsduur" id="Tijdsduur" value="<?php echo htmlspecialchars($result['Tijdsduur']); ?>" required>

        <input type="submit" value="Opslaan">
    </form>
</body>
</html>
