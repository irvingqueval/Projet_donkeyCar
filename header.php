<?php
require_once "config.php";
$pdo = new \PDO(DSN, USER);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Donkye Car</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Donkey Car</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              CRUD
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Add Car</a></li>
              <li><a class="dropdown-item" href="#">Delete Car</a></li>
              <li><a class="dropdown-item" href="#">Update Car</a></li>
            </ul>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
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