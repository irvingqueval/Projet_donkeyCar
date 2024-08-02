<?php
include("header.php");

// Récupérer les catégories disponibles depuis la base de données
$query_categories = "SELECT id, nom FROM Category";
$ps_categories = $pdo->prepare($query_categories);
$ps_categories->execute();
$categories = $ps_categories->fetchAll(PDO::FETCH_ASSOC);

// Initialisation des variables de filtrage par défaut
$categoryFilter = null;
$search = '';
$results = [];

// Vérifier si une catégorie est sélectionnée
if (isset($_GET['Category'])) {
    $categoryFilter = $_GET['Category'];
}

// Vérifier si une recherche est effectuée
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}

// Construire la requête de base
$query = "SELECT v.id, v.model, v.description, v.Prix, v.details, v.image, GROUP_CONCAT(c.nom SEPARATOR ', ') AS category_names
          FROM voiture v
          LEFT JOIN VoitureCategory vc ON v.id = vc.voiture_id
          LEFT JOIN Category c ON vc.category_id = c.id";

// Ajouter les conditions pour les filtres
$conditions = [];
$params = [];

if ($categoryFilter) {
    $conditions[] = "c.id = :category_id";
    $params[':category_id'] = $categoryFilter;
}

if ($search) {
    $conditions[] = "v.model LIKE :search";
    $params[':search'] = '%' . $search . '%';
}

// Ajouter les conditions à la requête si nécessaire
if (count($conditions) > 0) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

// Ajouter la clause GROUP BY pour regrouper les résultats par voiture
$query .= " GROUP BY v.id, v.model, v.description, v.Prix, v.details, v.image";

// Ajouter la clause ORDER BY pour trier les résultats par modèle
$query .= " ORDER BY v.model";

// Préparer et exécuter la requête
$ps = $pdo->prepare($query);
foreach ($params as $key => &$value) {
    $ps->bindParam($key, $value);
}
$ps->execute();

// Récupérer les résultats
$results = $ps->fetchAll(PDO::FETCH_ASSOC);
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

        <?php foreach ($results as $voiture) { ?>
            <div class="col-md-4 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="<?= htmlspecialchars($voiture['image']); ?>" class="card-img-top" alt="Image de <?= htmlspecialchars($voiture['model']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($voiture['model']); ?></h5>
                        <p class="card-text"><?= htmlspecialchars($voiture['description']); ?></p>
                        <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($voiture['Prix']); ?>€</h6>
                        <p class="card-text"><?= htmlspecialchars($voiture['details']); ?></p>
                        <p class="card-text">Catégories : <?= htmlspecialchars($voiture['category_names']); ?></p>
                        <div class="d-flex justify-content-between">
                            <a class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?');" href="voiture/deletecars.php?id=<?= htmlspecialchars($voiture['id']); ?>">Supprimer</a>
                            <a class="btn btn-primary" href="voiture/updatecars.php?id=<?= htmlspecialchars($voiture['id']); ?>">Mettre à jour</a>
                        </div>
                        <button type="button" class="btn btn-outline-success">
                            <a href="reservation.php?Id=<?= $voiture['id']; ?>">Réserver</a>
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
