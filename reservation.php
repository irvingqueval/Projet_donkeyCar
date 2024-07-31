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

if ($donkeycar_voiture) {
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
                    <p class="card-text"><?= nl2br(htmlspecialchars($donkeycar_voiture['details'])); ?></p>
                    <a href="#" class="btn btn-primary">Plus de détails</a>
                </div>
            </div>
        </div>
    </div>
</div>




<?php
} else {
    echo "La voiture n'existe pas.";
}

?>