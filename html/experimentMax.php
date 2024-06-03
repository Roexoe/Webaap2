<?php
ob_start();
include_once('connection.php'); // Zorg ervoor dat het pad correct is naar je PDO-verbinding bestand

// Functie om een unieke bestandsnaam te genereren
function generateUniqueFileName($filename) {
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $basename = pathinfo($filename, PATHINFO_FILENAME);
    $timestamp = date('YmdHis');
    return $basename . '_' . $timestamp . '.' . $extension;
}

// Check of het formulier is verzonden
if (isset($_POST['submit'])) {
    // Ontvang de formuliergegevens
    $reisnaam = $_POST['reisnaam'];
    $omschrijving = $_POST['omschrijving'];
    $personen = $_POST['personen'];
    $stad = $_POST['stad'];
    $prijs = $_POST['prijs'];
    $tijdsduur = $_POST['tijdsduur'];
    
    // Bestandsupload
    $uploadDir = 'html/img/'; // Map waarin de bestanden worden opgeslagen
    $uploadedFile = $uploadDir . basename($_FILES['reisfoto']['name']);
    $fileType = strtolower(pathinfo($uploadedFile, PATHINFO_EXTENSION));
    $uploadOk = 1;

    // Controleer of het bestand een afbeelding is
    $check = getimagesize($_FILES['reisfoto']['tmp_name']);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Het bestand is geen afbeelding.";
        $uploadOk = 0;
    }

    // Controleer of het bestand al bestaat
    if (file_exists($uploadedFile)) {
        echo "Sorry, het bestand bestaat al.";
        $uploadOk = 0;
    }

    // Controleer de bestandsgrootte (maximaal 5 MB)
    if ($_FILES['reisfoto']['size'] > 5000000) {
        echo "Sorry, het bestand is te groot.";
        $uploadOk = 0;
    }

    // Sta alleen bepaalde bestandstypen toe
    if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif") {
        echo "Sorry, alleen JPG, JPEG, PNG & GIF bestanden zijn toegestaan.";
        $uploadOk = 0;
    }

    // Als uploadOk nog steeds 1 is, upload dan het bestand
    if ($uploadOk == 1) {
        // Genereer een unieke bestandsnaam om conflicten te voorkomen
        $uniqueFilename = generateUniqueFileName($_FILES['reisfoto']['name']);
        $uploadedFile = $uploadDir . $uniqueFilename;
        if (move_uploaded_file($_FILES['reisfoto']['tmp_name'], $uploadedFile)) {
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
                ':reisfoto' => $uploadedFile // Opslaan van het pad naar het geüploade bestand
            ])) {
                // Terug naar het admin paneel na succesvolle toevoeging
                header('Location: adminpanelreizen.php');
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $pdo->errorInfo()[2]; // Gebruik $pdo->errorInfo() in plaats van $conn->error
                exit();
            }
        } else {
            echo "Sorry, er was een probleem bij het uploaden van het bestand.";
        }
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
    <form action="add.php" method="post" enctype="multipart/form-data">
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

        <label for="reisfoto">Foto:</label>
        <input type="file" name="reisfoto" id="reisfoto" accept="image/*" required><br>

        <input type="submit" name="submit" value="Opslaan" class="button">
    </form>
</body>
</html>
