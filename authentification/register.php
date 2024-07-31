<?php
require_once "../header.php"; // Inclut le header qui établit la connexion à la base de données

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql); // Utilisation de $pdo qui est défini dans header.php
    $stmt->bindParam(1, $email);
    $stmt->bindParam(2, $password);
    if ($stmt->execute()) {
        header("Location: success_register.php");
    } else {
        $error = "Error: " . $stmt->errorInfo()[2];
    }
}
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mt-5">Create an Account</h2>
            <?php if ($error): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            <form method="post" action="register.php">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
                <a href="login.php" class="btn btn-secondary">Back to Login</a>
            </form>
        </div>
