<?php
include "../header.php";
?>

<div class="container mt-5">
    <?php if (isset($_GET['status']) && $_GET['status'] == 'success') : ?>
        <div class="alert alert-success" role="alert">
            La mise à jour a été effectuée avec succès !
        </div>
    <?php else : ?>
        <div class="alert alert-danger" role="alert">
            Une erreur s'est produite pendant la mise à jour.
        </div>
    <?php endif; ?>
    <a href="../index.php" class="btn btn-primary">Retour à l'accueil</a>
</div>