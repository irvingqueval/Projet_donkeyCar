<?php
include("../header.php");

if (!$isAdmin) {
    // Redirigez vers la page d'accueil si l'utilisateur n'est pas administrateur
    header("Location: /access_denied.php");
    exit;
}

// Requête pour récupérer les catégories
$query = "SELECT * FROM Category";
$statement = $pdo->query($query);
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les détails de la nouvelle voiture
    $model = $_POST['model'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $details = $_POST['details'];
    $image = $_FILES['image'];
    $categoryIds = $_POST['categories'] ?? [];

    // Gérer l'upload de l'image
    // Définir le répertoire cible pour le stockage de l'image
    $target_dir = __DIR__ . "../../image/";
    // Vérifier si le répertoire cible existe, sinon le créer
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $image_name = basename($image["name"]);
    $target_file = $target_dir . $image_name;
    $relative_path = "/image/" . $image_name;

    // Déplacer le fichier uploadé vers le répertoire cible
    if (move_uploaded_file($image["tmp_name"], $target_file)) {
        // Préparer et exécuter la requête d'insertion
        $query = "INSERT INTO voiture (model, description, Prix, details, image) VALUES (:model, :description, :prix, :details, :image)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':model', $model, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':prix', $prix, PDO::PARAM_INT);
        $stmt->bindParam(':details', $details, PDO::PARAM_STR);
        $stmt->bindParam(':image', $relative_path, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $voitureId = $pdo->lastInsertId();
            // Insertion des catégories
            foreach ($categoryIds as $categoryId) {
                $query = "INSERT INTO VoitureCategory (voiture_id, category_id) VALUES (:voiture_id, :category_id)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':voiture_id', $voitureId, PDO::PARAM_INT);
                $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
                $stmt->execute();
            }
            header("Location: success_addcar.php");
            exit;
        } else {
            echo "Erreur d'ajout de voiture.";
        }
    } else {
        echo "Erreur de téléchargement de l'image.";
    }
}
?>

<div class="container mt-4">
    <h2>Add New Car</h2>
    <form action="addcars.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="model" class="form-label">Modèle</label>
            <input type="text" class="form-control" id="model" name="model" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="mb-3">
            <label for="prix" class="form-label">Prix</label>
            <input type="number" class="form-control" id="prix" name="prix" required>
        </div>
        <div class="mb-3">
            <label for="categories" class="form-label">Catégories</label><br>
            <?php foreach ($categories as $category) : ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="category<?= $category['Id'] ?>" name="categories[]" value="<?= $category['Id'] ?>">
                    <label class="form-check-label" for="category<?= $category['Id'] ?>"><?= $category['nom'] ?></label>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="mb-3">
            <label for="details" class="form-label">Détails</label>
            <textarea class="form-control" id="details" name="details" required></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Poster de la voiture</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Ajouter une voiture</button>
    </form>
</div>

</body>

</html>