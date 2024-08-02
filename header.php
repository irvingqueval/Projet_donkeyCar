<?php
require_once "config.php";
$pdo = new \PDO(DSN, USER);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Donkey Car</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="/index.php">Donkey Car</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/index.php">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/voiture/addcars.php">Ajouter une voiture</a>
          </li>
        </ul>
        <form class="d-flex" role="search" method="POST" action="/index.php">
          <input class="form-control me-2" type="search" name="search" placeholder="search" aria-label="Search" value="<?php echo htmlspecialchars($_POST['search'] ?? ''); ?>">
          <button class="btn btn-outline-success" type="submit">Recherche</button>
        </form>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a id="historique" class="nav-link active" href="/historique.php">Historique</a>
          </li>
        </ul>
        <?php if (isset($_SESSION["userid"])) { ?>
          <p><?php echo $_SESSION["user_email"]; ?></p>
          <a class="nav-link" href="/authentification/logout.php">
            <img src="/logo/Logout.webp" alt="Logout" style="width: 40px; height: 40px;">
          </a>
        <?php } else { ?>
          <a class="nav-link" href="/authentification/login.php">
            <img src="/logo/connexion.webp" alt="Login" style="width: 40px; height: 40px;">
          </a>
        <?php } ?>
      </div>
    </div>
  </nav>

</body>

</html>