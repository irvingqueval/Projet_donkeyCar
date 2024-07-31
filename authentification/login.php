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
        $error = "Invalid email or password.";
    }
}
?>

<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mt-5">Login</h2>
            <?php if ($error): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            <form method="post" action="login.php">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <a href="register.php" class="btn btn-secondary">Create an Account</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
