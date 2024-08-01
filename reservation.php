<?php
require_once "header.php";

$voitureId = $_GET['Id'];

$query = "
    SELECT v.Id, v.model, v.description, v.Prix, v.details, v.image, GROUP_CONCAT(c.nom SEPARATOR ', ') AS categories 
    FROM voiture v 
    JOIN VoitureCategory vc ON v.Id = vc.voiture_id
    JOIN Category c ON vc.Category_Id = c.Id
    WHERE v.Id = ?
    GROUP BY v.Id, v.model, v.description, v.Prix, v.details, v.image
";
$ps = $pdo->prepare($query);
$ps->execute([$voitureId]);
$donkeycar_voiture = $ps->fetch();

?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-lg" style="padding: 20px;"> <!-- Ajout d'un padding général à la carte -->
                    <img src="<?= htmlspecialchars($donkeycar_voiture['image']); ?>" class="card-img-top" alt="<?= htmlspecialchars($donkeycar_voiture['model']); ?>" style="border-top-left-radius: .5rem; border-top-right-radius: .5rem; max-height: 300px; width: auto; display: block; margin: 0 auto;"> <!-- Centrage de l'image -->
                    <div class="card-body text-center"> <!-- Centrage du texte de la carte -->
                        <h5 class="card-title text-uppercase text-primary"><?= htmlspecialchars($donkeycar_voiture['model']); ?></h5>
                        <p class="card-text"><strong>Catégories:</strong> <?= htmlspecialchars($donkeycar_voiture['categories']); ?></p>
                        <h6 class="card-subtitle mb-3 text-muted">Prix à la journée : <?= htmlspecialchars($donkeycar_voiture['Prix']); ?>€</h6>
                        <!-- Formulaire de réservation -->
                        <form method="post" id="reservationForm" class="text-start" name="toto">
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Date de début:</label>
                                <input type="date" id="start_date" name="start_date" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="end_date" class="form-label">Date de fin:</label>
                                <input type="date" id="end_date" name="end_date" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="assurance_annulation" class="form-label">Assurance annulation:</label>
                                <input type="checkbox" id="assurance_annulation" name="assurance_annulation" class="form-check-input">
                            </div>
                            <div class="mb-3">
                                <label for="assurance_annulation" class="form-label">Kilométrage illimiter:</label>
                                <input type="checkbox" id="km_illimiter" name="km_illimiter" class="form-check-input">
                            </div>
                            <div for="prix_total" id="prix_total" class="alert alert-info">Prix total: </div>
                            <button type="submit" class="btn btn-outline-primary" name="Reserver">Reserver</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const startDate = document.getElementById('start_date');
            const endDate = document.getElementById('end_date');
            const totalPrix = document.getElementById('prix_total');
            const prixJour = <?= json_encode($donkeycar_voiture['Prix']); ?>;
            const assuranceAnnulation = document.getElementById('assurance_annulation');
            const kmIllimiter = document.getElementById('km_illimiter');

            function calculateTotal() {
                const start = new Date(startDate.value);
                const end = new Date(endDate.value);
                const timeDiff = Math.abs(end - start);
                const diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

                let total = diffDays * prixJour;

                if (assuranceAnnulation.checked) {
                    total += 20; // Supposons 20€ pour l'assurance annulation
                }
                if (kmIllimiter.checked) {
                    total += 50; // Supposons 50€ pour le kilométrage illimité
                }

                totalPrix.innerHTML = 'Prix total: ' + total.toFixed(2) + '€';
            }

            startDate.addEventListener('change', calculateTotal);
            endDate.addEventListener('change', calculateTotal);
            assuranceAnnulation.addEventListener('change', calculateTotal);
            kmIllimiter.addEventListener('change', calculateTotal);
        });
    </script>
<?php

if (!empty($_POST) && isset($_SESSION["userid"])) {
    // Récupérer les informations du formulaire
    $user_id = $_SESSION["userid"];
    $start_date = new DateTime($_POST["start_date"]);
    $end_date = new DateTime($_POST["end_date"]);
    $nb_days = ($end_date->diff($start_date))->format("%a");
    $assurance_annulation = isset($_POST["assurance_annulation"]) ? 1 : 0;
    $km_illimiter = isset($_POST["km_illimiter"]) ? 1 : 0;
    $prix_total = (int)$nb_days * (float)$donkeycar_voiture['Prix'] + ($assurance_annulation ? 20 : 0) + ($km_illimiter ? 50 : 0);

    $query = "INSERT INTO Reservation (user_id, voiture_id, start_date, end_date, assurance_annulation, km_illimiter, prix_total) VALUES (:user_id, :voiture_id, :start_date, :end_date, :assurance_annulation, :km_illimiter, :prix_total)";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':voiture_id', $voitureId, PDO::PARAM_INT);
    $stmt->bindParam(':start_date', $_POST["start_date"], PDO::PARAM_STR);
    $stmt->bindParam(':end_date', $_POST["end_date"], PDO::PARAM_STR);
    $stmt->bindParam(':assurance_annulation', $assurance_annulation, PDO::PARAM_INT);
    $stmt->bindParam(':km_illimiter', $km_illimiter, PDO::PARAM_INT);
    $stmt->bindParam(':prix_total', $prix_total, PDO::PARAM_STR);
    $stmt->execute();
}