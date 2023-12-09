<?php
session_start();

// Hardcoded credentials for demonstration
const USERNAME = 'admin';
const PASSWORD = 'Pass_0123';

// Max login attempts
const MAX_ATTEMPTS = 3;

// Track login attempts
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_SESSION['login_attempts'] < MAX_ATTEMPTS) {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Simple credential check
        if ($username === USERNAME && $password === PASSWORD) {
            $message = 'Login successful!';
            $_SESSION['login_attempts'] = 0; // Reset attempts after successful login
        } else {
            $_SESSION['login_attempts']++;
            $message = 'Invalid credentials!';
        }
    } else {
        $message = 'Account locked due to too many failed login attempts.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - Most Secure Shop Ever</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Secure Shop</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="search.php">Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="files.php">Files</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="mb-4">Admin Login</h1>
        <?php if ($_SESSION['login_attempts'] < MAX_ATTEMPTS): ?>
            <form method="post" action="admin_login.php">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        <?php else: ?>
            <p class="alert alert-danger">Account locked due to too many failed login attempts.</p>
        <?php endif; ?>
        <?php if ($message): ?>
            <p class="alert alert-warning"><?= $message ?></p>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
