<?php include("header.php");
$query = "SELECT * FROM voiture";
$ps = $pdo->prepare($query);
$ps->execute();
?>

<div class="container mt-4">
    <div class="row">
        <?php while ($donkeycar_voiture = $ps->fetch()) { ?>
            <div class="col-md-4 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="<?= $donkeycar_voiture['image']; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $donkeycar_voiture['model']; ?></h5>
                        <p class="card-text"><?= $donkeycar_voiture['description']; ?></p>
                        <h6 class="card-subtitle mb-2 text-muted"><?= $donkeycar_voiture['Prix']; ?>€</h6>
                        <p class="card-text"><?= $donkeycar_voiture['details']; ?></p>
                    </div>
                </div> 
            </div>
        <?php } ?>
    </div>
</div>

</body>

</html>
