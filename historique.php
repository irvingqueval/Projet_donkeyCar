<?php
require_once "header.php";

// Check if the user is logged in and redirect to the login page if not
if (empty($_SESSION['userid'])) {
    header('Location: authentification/login.php');
}

$user_ID = $_SESSION['userid'];
// Get the current date
$current_date = date('Y-m-d');

// Fetch current reservations
$sql_current = "
    SELECT 
        r.ID, v.model, v.image, r.start_date, r.end_date, r.assurance_annulation, r.km_illimiter, r.prix_total 
    FROM 
        Reservation r 
    JOIN 
        voiture v 
    ON 
        r.voiture_ID = v.id 
    WHERE 
        r.user_id = :user_ID AND r.end_date >= :current_date";
$stmt_current = $pdo->prepare($sql_current);
$stmt_current->execute(['user_ID' => $user_ID, 'current_date' => $current_date]);
$current_reservations = $stmt_current->fetchAll();

// Fetch past reservations
$sql_past = "
    SELECT 
        r.ID, v.model, v.image, r.start_date, r.end_date, r.assurance_annulation, r.km_illimiter, r.prix_total 
    FROM 
        Reservation r 
    JOIN 
        voiture v
    ON 
        r.voiture_ID = v.id 
    WHERE 
        r.user_id = :user_ID AND r.end_date < :current_date";
$stmt_past = $pdo->prepare($sql_past);
$stmt_past->execute(['user_ID' => $user_ID, 'current_date' => $current_date]);
$past_reservations = $stmt_past->fetchAll();
?>

<div class="container mt-5">
    <h1 class="mb-4">Historique des Réservations</h1>
    <h2 class="mb-3">Réservations en cours</h2>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Modèle</th>
                <th>Image</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Assurance Annulation</th>
                <th>KM Illimiter</th>
                <th>Prix Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($current_reservations) > 0) {
                foreach ($current_reservations as $row) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["model"]) . "</td>";
                    echo "<td><img src='" . htmlspecialchars($row["image"]) . "' alt='" . htmlspecialchars($row["model"]) . "' width='100'></td>";
                    echo "<td>" . htmlspecialchars($row["start_date"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["end_date"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["assurance_annulation"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["km_illimiter"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["prix_total"]) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Aucune réservation en cours</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <h2 class="mt-5 mb-3">Réservations passées</h2>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Modèle</th>
                <th>Image</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Assurance Annulation</th>
                <th>KM Illimiter</th>
                <th>Prix Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($past_reservations) > 0) {
                foreach ($past_reservations as $row) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["model"]) . "</td>";
                    echo "<td><img src='" . htmlspecialchars($row["image"]) . "' alt='" . htmlspecialchars($row["model"]) . "' width='100'></td>";
                    echo "<td>" . htmlspecialchars($row["start_date"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["end_date"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["assurance_annulation"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["km_illimiter"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["prix_total"]) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Aucune réservation passée</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>