<?php
include("../header.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les détails de la nouvelle voiture
    $model = $_POST['model'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $details = $_POST['details'];
    $image = $_POST['image'];

    // Préparer et exécuter la requête d'insertion
    $query = "INSERT INTO voiture (model, description, Prix, details, image) VALUES (:model, :description, :prix, :details, :image)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':model', $model);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':prix', $prix);
    $stmt->bindParam(':details', $details);
    $stmt->bindParam(':image', $image);

    if ($stmt->execute()) {
        header("Location: index.php?message=Car added successfully");
        exit;
    } else {
        echo "Error adding car.";
    }
}
?>

<div class="container mt-4">
    <h2>Add New Car</h2>
    <form action="addcars.php" method="post">
        <div class="form-group">
            <label for="model">Model</label>
            <input type="text" class="form-control" id="model" name="model" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="prix">Price</label>
            <input type="number" class="form-control" id="prix" name="prix" required>
        </div>
        <div class="form-group">
            <label for="details">Details</label>
            <textarea class="form-control" id="details" name="details" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image URL</label>
            <input type="text" class="form-control" id="image" name="image" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Add Car</button>
    </form>
</div>

</body>

</html>