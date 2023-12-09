<?php
session_start();

// Base directory for file access - restrict file access to this directory
$base_dir = 'files/';

// Function to list files in directory
function listFilesInDirectory($dir)
{
    if (is_file($dir))
        return array($dir . ' ('. filetype($dir) . ')');
    $files = scandir($dir);
    $fileList = array();
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            $fileList[] = $file . ' (' . filetype($dir . $file) . ')';
        }
    }
    return $fileList;
}

$directoryContents = listFilesInDirectory($base_dir);

// Check if form is submitted and file name is provided
if (isset($_POST['filename']) || isset($_SESSION['filename'])) {
    $sanitize = isset($_POST['sanitize']) ? true : false;
    $filename = $_POST['filename'] ?? $_SESSION['filename'];

    // Save to session
    $_SESSION['filename'] = $filename;
    $_SESSION['sanitize'] = $sanitize;

    // Sanitize file path if required
    if ($sanitize) {
        $filename = preg_replace('/[^a-zA-Z0-9]/', '', $filename);
    }

    // Build the full file path
    $file_path = $base_dir . $filename;
    $directoryContents = listFilesInDirectory($file_path);

    // Check if file exists in the base directory
    if (file_exists($file_path) && is_readable($file_path) && strpos($file_path, $base_dir) === 0) {
        $file_content = file_get_contents($file_path);
    } else {
        $file_content = 'File not found or access denied.';
    }
} else {
    $file_content = 'No file selected.';
}

// Clear session if 'clear' button is pressed
if (isset($_POST['clear'])) {
    session_unset();
    $file_content = 'No file selected.';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Directory Traversal Demo - Most Secure Shop Ever</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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
        <h1 class="mb-4">Directory Traversal Demonstration</h1>

        <h3>Current Directory Contents:</h3>
        <ul>
            <?php foreach ($directoryContents as $file) : ?>
                <li><?= htmlspecialchars($file) ?></li>
            <?php endforeach; ?>
        </ul>

        <form method="post" action="files.php" class="mb-3">
            <div class="form-group">
                <input type="text" class="form-control" name="filename" placeholder="Enter filename" value="<?= htmlspecialchars($_SESSION['filename'] ?? '') ?>">
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" name="sanitize" id="sanitize" <?= isset($_SESSION['sanitize']) && $_SESSION['sanitize'] ? 'checked' : '' ?>>
                <label class="form-check-label" for="sanitize">Sanitize Input</label>
            </div>
            <button type="submit" class="btn btn-primary">View File</button>
            <button type="submit" name="clear" class="btn btn-secondary">Clear</button>
        </form>

        <h2>File Content:</h2>
        <div class="bg-light p-3 border rounded">
            <pre class="mb-0"><?= htmlspecialchars($file_content) ?></pre>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>