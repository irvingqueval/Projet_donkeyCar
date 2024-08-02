<?php
include("../header.php");

if (isset($_GET['id'])) {
    $car_id = $_GET['id'];

    // Préparer et exécuter la requête de suppression
    $query = "DELETE FROM voiture WHERE id = :car_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':car_id', $car_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redirection après suppression
        header("Location: ../index.php");
        exit;
    } else {
        echo "Error deleting car.";
    }
} else {
    echo "No car ID specified.";
}
