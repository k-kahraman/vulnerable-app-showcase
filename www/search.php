<?php
// Connection to the database
$mysqli = new mysqli("db", "root", "root", "secure_shop");

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$search = $_GET['search'] ?? '';
$sanitize = isset($_GET['sanitize']) && $_GET['sanitize'] == 'on';

if ($sanitize) {
    $search = $mysqli->real_escape_string($search);
}
$query = "SELECT name, description, price FROM items WHERE name = '$search';";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results - Most Secure Shop Ever</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-3">Search Results</h1>
        <form action="sql.php" method="GET" class="mb-4">
            <div class="form-group">
                <input type="text" class="form-control" name="search" placeholder="Search for items..." value="<?= htmlspecialchars($search) ?>">
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" name="sanitize" id="sanitize" <?= $sanitize ? 'checked' : '' ?>>
                <label class="form-check-label" for="sanitize">Sanitize Input</label>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <?php
        if ($mysqli->multi_query($query)) {
            do {
                if ($result = $mysqli->store_result()) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='card mb-3'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>" . htmlspecialchars($row['name']) . "</h5>";
                        echo "<p class='card-text'>" . htmlspecialchars($row['description']) . "</p>";
                        echo "<p class='card-text'><small class='text-muted'>Price: $" . htmlspecialchars($row['price']) . "</small></p>";
                        echo "</div>";
                        echo "</div>";
                    }
                    $result->free();
                }
            } while ($mysqli->next_result());
        } else {
            echo "<p>No results found.</p>";
        }

        $mysqli->close();
        ?>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
