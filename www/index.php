<?php
// Connection to the database
$mysqli = new mysqli("db", "root", "root", "secure_shop");

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Query to fetch items
$result = $mysqli->query("SELECT * FROM items");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Most Secure Shop Ever</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card-custom {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Secure Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="sql.php">Search</a>
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

    <div class="container">
        <h1 class="mt-4">Welcome to the Most Secure Shop Ever</h1>
        <form action="search.php" method="GET" class="form-inline mt-3 mb-3">
            <input type="text" name="search" class="form-control mr-sm-2" placeholder="Search for items...">
            <button type="submit" class="btn btn-outline-success">Search</button>
        </form>
        <div class="row">
            <?php while ($row = $result->fetch_assoc()) : ?>
                <div class="col-md-4">
                    <div class="card card-custom">
                        <a href="comments.php?item_id=<?= $row['id'] ?>" class="card-body text-dark" style="text-decoration: none;">
                            <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($row['description']) ?></p>
                            <p class="card-text"><small class="text-muted">Price: $<?= htmlspecialchars($row['price']) ?></small></p>
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
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