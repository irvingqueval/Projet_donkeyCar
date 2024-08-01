<?php
require "header.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les informations du formulaire
    $user_id = $_POST["user_id"];
    $voiture_id = $_POST["voiture_id"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $assurance_annulation = isset($_POST["assurance_annulation"]) ? 1 : 0;
    $km_illimiter = isset($_POST["km_illimiter"]) ? 1 : 0;
    $prix_total = $_POST["prix_total"];

    $query = "INSERT INTO Reservation (user_id, voiture_id, start_date, end_date, assurance_annulation, km_illimiter, prix_total) VALUES (:user_id, :voiture_id, :start_date, :end_date, :assurance_annulation, :km_illimiter, :prix_total)";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':voiture_id', $voiture_id, PDO::PARAM_INT);
    $stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
    $stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
    $stmt->bindParam(':assurance_annulation', $assurance_annulation, PDO::PARAM_INT);
    $stmt->bindParam(':km_illimiter', $km_illimiter, PDO::PARAM_INT);
    $stmt->bindParam(':prix_total', $prix_total, PDO::PARAM_STR);
    $stmt->execute();
} else {
    echo "Invalid request";
}