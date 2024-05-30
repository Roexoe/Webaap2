<?php
include_once('connection.php'); // Ensure the path is correct to your PDO connection file

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $source = isset($_GET['source']) ? $_GET['source'] : 'adminpanelreizen'; // Default to adminpanelreizen if no source is provided

    if ($id) {
        // Delete from Reizen table
        $stmt_reizen = $pdo->prepare('DELETE FROM Reizen WHERE id = :id');
        $stmt_reizen->bindParam(':id', $id);
        $reizen_deleted = $stmt_reizen->execute();

        // Delete from Klanteninformatie table
        $stmt_klanten = $pdo->prepare('DELETE FROM Klanteninformatie WHERE id = :id');
        $stmt_klanten->bindParam(':id', $id);
        $klanten_deleted = $stmt_klanten->execute();

        if ($reizen_deleted && $klanten_deleted) {
            // Redirect based on the source parameter
            if ($source === 'adminpanelklanten') {
                header('Location: adminpanelklanten.php');
            } else {
                header('Location: adminpanelreizen.php');
            }
            exit;
        } else {
            // Display an error message if any of the queries fail
            echo "Error deleting record.";
        }
    } else {
        // Display an error message if no ID is provided
        echo "No ID provided for deletion.";
    }
}
?>
