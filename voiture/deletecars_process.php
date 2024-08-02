<?php
include "../header.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_id = $_POST['car_id']; // Assurez-vous que le nom correspond au formulaire

    // Requête pour supprimer la voiture
    $sql = "DELETE FROM voiture WHERE id = :car_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':car_id', $car_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Car deleted successfully.";
    } else {
        echo "Error deleting car.";
    }
}
