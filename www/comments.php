<?php
session_start();
$mysqli = new mysqli("db", "root", "Admin_0123", "secure_shop");

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Get item ID
$item_id = $_GET['item_id'] ?? 0;

// Fetch item details
$item_query = $mysqli->prepare("SELECT * FROM items WHERE id = ?");
$item_query->bind_param("i", $item_id);
$item_query->execute();
$item_result = $item_query->get_result();
$item = $item_result->fetch_assoc();

// Handle comment submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])) {
    $comment = $_POST['comment'];
    $sanitize = isset($_POST['sanitize']) ? true : false;

    // Sanitize comment if the checkbox is checked
    if ($sanitize) {
        $comment = htmlspecialchars($comment, ENT_QUOTES, 'UTF-8');
    }

    // Store the comment in a session
    $_SESSION['comments'][$item_id][] = $comment;
}

// Retrieve comments for the item
$comments = $_SESSION['comments'][$item_id] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($item['name']) ?> - Comments</title>
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
        <h1><?= htmlspecialchars($item['name']) ?></h1>
        <p><?= htmlspecialchars($item['description']) ?></p>
        <h2>Comments</h2>
        <form action="comments.php?item_id=<?= htmlspecialchars($item_id) ?>" method="post">
            <div class="form-group">
                <label for="comment">Your Comment:</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="sanitize" name="sanitize">
                <label class="form-check-label" for="sanitize">Sanitize Comment</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit Comment</button>
        </form>

        <div class="mt-4">
            <h3>Comments:</h3>
            <?php foreach ($comments as $comment): ?>
                <div class="border-bottom mb-2">
                    <?= $comment; // Displaying comment (sanitized or not based on user choice) ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$mysqli->close();
?>
