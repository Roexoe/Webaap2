<?php
include_once('connection.php'); // Ensure the path is correct to your PDO connection file

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $source = isset($_GET['source']) ? $_GET['source'] : 'adminpanelreizen'; // Default to adminpanelreizen if no source is provided

    if ($id) {
        $stmt = $pdo->prepare('DELETE FROM Reizen WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    // Redirect based on the source parameter
    if ($source === 'adminpanelklanten') {
        header('Location: adminpanelklanten.php');
    } else {
        header('Location: adminpanelreizen.php');
    }
    exit;
}
?>