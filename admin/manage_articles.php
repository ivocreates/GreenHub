<?php
session_start();
include '../php/database.php'; // Include your database connection

// Check if the admin is logged in
if (!isset($_SESSION['user'])) {
    header("Location: ../admin/login.php"); // Redirect to login if not logged in
    exit;
}

// Fetch all articles from the database
$stmt = $conn->prepare("SELECT id, title, created_at FROM articles");
$stmt->execute();
$articles = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manage Articles</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<header>
    <h1>Admin Dashboard - Manage Articles</h1>
    <nav>
        <a href="../admin/dashboard.php">Dashboard</a>
        <a href="../php/logout.php">Logout</a>
    </nav>
</header>

<main class="dashboard-container">
    <h2>Manage Articles</h2>
    <a href="create_article.php" class="btn">Create New Article</a>

    <!-- Display all articles -->
    <table class="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Created On</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
                <tr>
                    <td><?php echo htmlspecialchars($article['id']); ?></td>
                    <td><?php echo htmlspecialchars($article['title']); ?></td>
                    <td><?php echo htmlspecialchars($article['created_at']); ?></td>
                    <td>
                        <a href="edit_article.php?id=<?php echo $article['id']; ?>" class="btn btn-edit">Edit</a>
                        <a href="delete_article.php?id=<?php echo $article['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this article?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

</body>
</html>
