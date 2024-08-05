<?php
include("../header.php");

if (!$isAdmin) {
    // Redirigez vers la page d'accueil si l'utilisateur n'est pas administrateur
    header("Location: /access_denied.php");
    exit;
}

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
