<?php
include_once('connection.php'); // Zorg ervoor dat het pad correct is naar je PDO-verbinding bestand

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    if ($id) {
        try {
            // Voorbereidingsquery om de boeking te verwijderen
            $stmt = $pdo->prepare('DELETE FROM Boekingen WHERE id = :id');
            $stmt->bindParam(':id', $id);
            
            // Uitvoeren van de verwijderquery
            $stmt->execute();
            
            // Terug naar de vorige pagina na het verwijderen
            header('Location: geboektereizen.php');
            exit;
        } catch (PDOException $e) {
            // Weergave van een foutmelding als er iets misgaat bij het verwijderen
            echo "Fout bij het verwijderen van de boeking: " . $e->getMessage();
        }
    } else {
        // Weergave van een foutmelding als er geen ID wordt meegegeven voor verwijdering
        echo "Geen ID opgegeven voor verwijdering.";
    }
}
?>
