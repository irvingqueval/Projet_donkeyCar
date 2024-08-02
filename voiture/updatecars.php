<?php
include("../header.php");

if (isset($_GET['id'])) {
    $car_id = $_GET['id'];

    // Récupérer les détails de la voiture à mettre à jour
    $query = "SELECT * FROM voiture WHERE id = :car_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':car_id', $car_id, PDO::PARAM_INT);
    $stmt->execute();
    $car = $stmt->fetch();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Mise à jour des détails de la voiture
        $model = $_POST['model'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $details = $_POST['details'];
        $image = $_POST['image'];

        $update_query = "UPDATE voiture SET model = :model, description = :description, Prix = :prix, details = :details, image = :image WHERE id = :car_id";
        $update_stmt = $pdo->prepare($update_query);
        $update_stmt->bindParam(':model', $model);
        $update_stmt->bindParam(':description', $description);
        $update_stmt->bindParam(':prix', $prix);
        $update_stmt->bindParam(':details', $details);
        $update_stmt->bindParam(':image', $image);
        $update_stmt->bindParam(':car_id', $car_id, PDO::PARAM_INT);

        if ($update_stmt->execute()) {
            header("Location: ../index.php");
            exit;
        } else {
            echo "Error updating car.";
        }
    }
} else {
    echo "No car ID specified.";
}
?>

<div class="container mt-4">
    <h2>Update Car</h2>
    <?php if ($car): ?>
        <form method="post">
            <div class="form-group">
                <label for="model">Model</label>
                <input type="text" class="form-control" id="model" name="model" value="<?= htmlspecialchars($car['model']); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required><?= htmlspecialchars($car['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="prix">Price</label>
                <input type="number" class="form-control" id="prix" name="prix" value="<?= htmlspecialchars($car['Prix']); ?>" required>
            </div>
            <div class="form-group">
                <label for="details">Details</label>
                <textarea class="form-control" id="details" name="details" required><?= htmlspecialchars($car['details']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image URL</label>
                <input type="text" class="form-control" id="image" name="image" value="<?= htmlspecialchars($car['image']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Car</button>
        </form>
    <?php else: ?>
        <p>No car found.</p>
    <?php endif; ?>
</div>

</body>

</html>