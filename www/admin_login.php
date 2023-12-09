<?php
session_start();

// Hardcoded credentials for demonstration
const USERNAME = 'admin';
const PASSWORD = 'password';

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
    <title>Brute Force Demo - Most Secure Shop Ever</title>
</head>
<body>
    <h1>Brute Force Login Demonstration</h1>
    <?php if ($_SESSION['login_attempts'] < MAX_ATTEMPTS): ?>
        <form method="post" action="bruteforce.php">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br><br>
            <button type="submit">Login</button>
        </form>
    <?php endif; ?>
    <p><?= $message ?></p>
</body>
</html>
