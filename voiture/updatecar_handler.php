<?php
include "../header.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $model = $_POST['model'];
    $description = $_POST['description'];
    $details = $_POST['details'];
    $prix = $_POST['prix'];
    $categories = $_POST['categories'] ?? [];

    // Vérifier que les champs obligatoires sont présents
    if (!$id || !$model || !$description || !$details || !$prix) {
        header("Location: success_updatecar.php?status=error");
        exit;
    }

    // Requête pour mettre à jour la série
    $query = "UPDATE voiture SET model = :model, details = :details, Prix = :prix, description = :description WHERE id = :id";
    $stm = $pdo->prepare($query);
    $stm->bindValue(":model", $model, PDO::PARAM_STR);
    $stm->bindValue(":details", $details, PDO::PARAM_STR);
    $stm->bindValue(":prix", $prix, PDO::PARAM_INT);
    $stm->bindValue(":description", $description, PDO::PARAM_STR);
    $stm->bindValue(":id", $id, PDO::PARAM_INT);

    // Exécuter la requête SQL
    if ($stm->execute()) {
        // Mise à jour des catégories
        $query = "DELETE FROM VoitureCategory WHERE voiture_id = :id";
        $stm = $pdo->prepare($query);
        $stm->bindValue(":id", $id, PDO::PARAM_INT);
        $stm->execute();

        foreach ($categories as $category_id) {
            $query = "INSERT INTO VoitureCategory (voiture_id, category_id) VALUES (:voiture_id, :category_id)";
            $stm = $pdo->prepare($query);
            $stm->bindValue(":voiture_id", $id, PDO::PARAM_INT);
            $stm->bindValue(":category_id", $category_id, PDO::PARAM_INT);
            $stm->execute();
        }

        // Gérer l'upload de l'image
        if ($_FILES['image']['name']) {
            $target_dir = __DIR__ . "../../image/";
            $image_name = basename($_FILES['image']['name']);
            $target_file = $target_dir . $image_name;
            $relative_path = "/image/" . $image_name;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $query = "UPDATE voiture SET image = :image WHERE id = :id";
                $stm = $pdo->prepare($query);
                $stm->bindValue(":image", $relative_path, PDO::PARAM_STR);
                $stm->bindValue(":id", $id, PDO::PARAM_INT);
                $stm->execute();
            } else {
                header("Location: success_updatecar.php?status=error");
                exit;
            }
        }

        // Rediriger vers la page de confirmation avec succès
        header("Location: success_updatecar.php?status=success");
        exit;
    } else {
        // Rediriger vers la page de confirmation avec erreur
        header("Location: success_updatecar.php?status=error");
        exit;
    }
} else {
    echo "Requête invalide.";
}
