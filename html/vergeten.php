<?php
include_once("connection.php");
include_once("header.php");
/**
 * @var PDO $pdo
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $geboortedatum = filter_input(INPUT_POST, 'Geboortedatum', FILTER_SANITIZE_STRING);
    $newPassword = filter_input(INPUT_POST, 'newPassword', FILTER_SANITIZE_STRING);
    $confirmPassword = filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_STRING);

    if (checkEmailAndBirthdateExists($email, $geboortedatum)) {
        if ($newPassword === $confirmPassword) {
            // Update het wachtwoord in de database
            $hashedPassword = $newPassword;
            $sql = "UPDATE Klanteninformatie SET Wachtwoord = :wachtwoord WHERE Mailadres = :mailadres";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':wachtwoord', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':mailadres', $email, PDO::PARAM_STR);
            $stmt->execute();

            echo "Je wachtwoord is succesvol gewijzigd.";
        } else {
            echo "De ingevoerde wachtwoorden komen niet overeen.";
        }
    } else {
        echo "Het opgegeven e-mailadres en/of geboortedatum komt niet overeen met een geregistreerd e-mailadres.";
    }
}

function checkEmailAndBirthdateExists($email, $geboortedatum) {
    global $pdo;
    $sql = "SELECT id FROM Klanteninformatie WHERE Mailadres = :mailadres AND Geboortedatum = :geboortedatum";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':mailadres', $email, PDO::PARAM_STR);
    $stmt->bindParam(':geboortedatum', $geboortedatum, PDO::PARAM_STR);
    $stmt->execute();
    $klant = $stmt->fetch(PDO::FETCH_ASSOC);
    return $klant ? true : false;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styling/style.css">
    <title>Wachtwoord vergeten</title>
</head>
<body>
    <h1>Wachtwoord vergeten</h1>
    <form method="POST" action="">
        <label for="email">E-mailadres:</label>
        <input type="email" name="email" required>
        <label for="Geboortedatum">Geboortedatum:</label>
        <input type="date" name="Geboortedatum" required>
        <label for="newPassword">Nieuw wachtwoord:</label>
        <input type="password" name="newPassword" required>
        <label for="confirmPassword">Bevestig nieuw wachtwoord:</label>
        <input type="password" name="confirmPassword" required>
        <button type="submit">Wijzig wachtwoord</button>
    </form>
</body>
</html>
