<?php
require_once "../header.php";  // Ensure this includes session_start()

$error = '';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $querry = "SELECT id, email, password FROM users WHERE email = ?";
    $stmt = $pdo->prepare($querry);
    $stmt->bindParam(1, $email);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['userid'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        header("Location: success_login.php");  // Redirect to a success page
        exit;
    } else {
        $error = "E-mail ou mot de passe non valide.";
    }
}
?>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mt-5">Se connecter</h2>
                <?php if ($error) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>
                <form method="post" action="login.php">
                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                    <a href="register.php" class="btn btn-secondary">Créer un compte</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>