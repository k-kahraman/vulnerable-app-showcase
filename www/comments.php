<?php
session_start();
$mysqli = new mysqli("db", "root", "root", "secure_shop");

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

// Handle comments logic here (similar to previous xss.php logic)

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($item['name']) ?> - Comments</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1><?= htmlspecialchars($item['name']) ?></h1>
        <p><?= htmlspecialchars($item['description']) ?></p>
        <h2>Comments</h2>
        <!-- Comment form and display logic here -->
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$mysqli->close();
?>
