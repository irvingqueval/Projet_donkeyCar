<?php
include "../header.php";
// Requête pour récupérer les catégories
$query = "SELECT * FROM category";
$statement = $pdo->query($query);
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
    <h2>Add a new car</h2>
    <form action="addcars.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="model" class="form-label">Car model</label>
            <input type="text" class="form-control" id="model" name="model" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="Prix" class="form-label">Price</label>
            <input type="number" class="form-control" id="Prix" name="Prix" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="details" class="form-label">Details</label>
            <textarea class="form-control" id="details" name="details" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Car image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Car</button>
    </form>
</div>