<?php
include "../header.php";

$id = $_GET['id'];

if (!$id) {
    echo "Aucun identifiant n'a été spécifié.";
    exit;
}

// Requête pour récupérer les informations de la série
$query = "SELECT * FROM voiture WHERE id = :id";
$stm = $pdo->prepare($query);
$stm->bindValue(":id", $id, PDO::PARAM_INT);
$stm->execute();
$voiture = $stm->fetch(PDO::FETCH_ASSOC);

if (!$voiture) {
    echo "Série introuvable.";
    exit;
}

// Requête pour récupérer les catégories
$query = "SELECT * FROM Category";
$statement = $pdo->query($query);
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);

// Requête pour récupérer les catégories associées à la série
$query = "SELECT category_id FROM VoitureCategory WHERE voiture_id = :id";
$stm = $pdo->prepare($query);
$stm->bindValue(":id", $id, PDO::PARAM_INT);
$stm->execute([':id' => $id]);
$VoitureCategories = $stm->fetchAll(PDO::FETCH_COLUMN, 0);
?>

<div class="container mt-5">
    <h2>Mise à jour de la voiture</h2>
    <form action="updatecar_handler.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
        <div class="mb-3">
            <label for="model" class="form-label">Modèle</label>
            <input type="text" class="form-control" id="model" name="model" value="<?= htmlspecialchars($voiture['model']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="<?= htmlspecialchars($voiture['description']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="prix" class="form-label">Prix</label>
            <input type="number" class="form-control" id="prix" name="prix" value="<?= htmlspecialchars($voiture['Prix']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="details" class="form-label">Détails</label>
            <textarea class="form-control" id="details" name="details" rows="3" required><?= htmlspecialchars($voiture['details']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="categories" class="form-label">Catégories</label><br>
            <?php foreach ($categories as $category) : ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="category<?= htmlspecialchars($category['Id']) ?>" name="categories[]" value="<?= htmlspecialchars($category['Id']) ?>" <?= in_array($category['Id'], $VoitureCategories) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="category<?= htmlspecialchars($category['Id']) ?>"><?= htmlspecialchars($category['nom']) ?></label>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="mb-3">
            <img src="<?= htmlspecialchars($voiture['image']); ?>" class="card-img-top" alt="Image de <?= htmlspecialchars($voiture['model']); ?>" style="max-width: 200px;"> <br>
            <label for="image" class="form-label">Poseter de la voiture</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>