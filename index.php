<?php
include("header.php");

// Récupérer les catégories disponibles depuis la base de données
$query_categories = "SELECT id, nom FROM Category";
$ps_categories = $pdo->prepare($query_categories);
$ps_categories->execute();
$categories = $ps_categories->fetchAll();

// Initialisation de la variable de filtrage par défaut
$categoryFilter = null;

// Vérifier si une catégorie est sélectionnée
if (isset($_GET['Category'])) {
    $categoryFilter = $_GET['Category'];
}

// Requête pour récupérer les voitures en fonction de la catégorie sélectionnée
if ($categoryFilter) {
    $query = "SELECT v.id, v.model, v.description, v.Prix, v.details, v.image 
              FROM voiture v
              JOIN VoitureCategory vc ON v.Id = vc.voiture_id
              JOIN Category c ON vc.Category_Id = c.Id
              WHERE c.Id = :category_id";
    $ps = $pdo->prepare($query);
    $ps->bindParam(':category_id', $categoryFilter);
} else {
    // Requête pour récupérer toutes les voitures si aucune catégorie n'est sélectionnée
    $query = "SELECT v.id, v.model, v.description, v.Prix, v.details, v.image FROM voiture v";
    $ps = $pdo->prepare($query);
}

$ps->execute();
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12 mb-3">
            <form action="index.php" method="GET">
                <div class="form-group">
                    <label for="Category">Filtrer par catégorie :</label>
                    <select class="form-control" id="Category" name="Category" onchange="this.form.submit()">
                        <option value="">Toutes les catégories</option>
                        <?php foreach ($categories as $cat) : ?>
                            <option value="<?= htmlspecialchars($cat['id']); ?>" <?= ($categoryFilter == $cat['id']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($cat['nom']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>
        </div>
        <?php while ($donkeycar_voiture = $ps->fetch()) { ?>
            <div class="col-md-4 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="<?= htmlspecialchars($donkeycar_voiture['image']); ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($donkeycar_voiture['model']); ?></h5>
                        <p class="card-text"><?= htmlspecialchars($donkeycar_voiture['description']); ?></p>
                        <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($donkeycar_voiture['Prix']); ?>€</h6>
                        <p class="card-text"><?= htmlspecialchars($donkeycar_voiture['details']); ?></p>
                        <div class="d-flex justify-content-between">
                            <a class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?');" href="voiture/deletecars.php?id=<?= htmlspecialchars($donkeycar_voiture['id']); ?>">Supprimer</a>
                            <a class="btn btn-primary" href="voiture/updatecars.php?id=<?= htmlspecialchars($donkeycar_voiture['id']); ?>">Mettre à jour</a>
                        </div>
                        <button type="button" class="btn btn-outline-success mt-2">
                            <a href="reservation.php?Id=<?= htmlspecialchars($donkeycar_voiture['id']); ?>">Réserver</a>
                        </button>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <!-- Ajouter un bouton pour ajouter une nouvelle voiture -->
    <div class="text-center mt-4">
        <a class="btn btn-success" href="addcars.php">Ajouter une voiture</a>
    </div>
</div>

</body>

</html>