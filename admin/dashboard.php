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

// Fetch all users from the database
$stmt = $conn->prepare("SELECT id, username, email, created_at FROM users");
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Fetch all forum posts from the database
$sql = "SELECT * FROM forum_posts ORDER BY created_at DESC";
$forumPosts = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - GreenHub</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<header>
    <h1>Admin Dashboard</h1>
    <nav>
        <a href="../admin/dashboard.php">Dashboard</a>
        <a href="../php/logout.php">Logout</a>
    </nav>
</header>

<main class="dashboard-container">
    <!-- Manage Users Section -->
    <section>
        <h2>Manage Users</h2>
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Registered On</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="btn btn-edit">Edit</a>
                            <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <!-- Manage Articles Section -->
    <section>
        <h2>Manage Articles</h2>
        <a href="create_article.php" class="btn">Create New Article</a>
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
    </section>

    <!-- Manage Forum Section -->
  
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> GreenHub. All rights reserved.</p>
</footer>

<!-- Go to Top Button -->
<a href="#" class="go-to-top" id="go-to-top">
    <i class="fas fa-arrow-up"></i>
</a>

<style>
/* General Styling */
.dashboard-container {
    max-width: 800px;
    margin: auto;
    padding: 20px;
    font-family: Arial, sans-serif;
}

.dashboard-container h2 {
    text-align: center;
    color: #333;
}

/* Post Card Styles */
.post-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px;
    background-color: #fefefe;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Button Styles */
.btn {
    background-color: #4CAF50; /* Green color */
    color: white;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    border-radius: 5px;
}

.btn:hover {
    background-color: #45a049; /* Darker green */
}

.go-to-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background-color: #4CAF50;
    color: white;
    padding: 10px;
    border-radius: 50%;
    display: none;
}

.go-to-top i {
    font-size: 20px;
}
</style>

<script>
// Show go to top button based on scroll position
window.onscroll = function() {
    const goToTopButton = document.getElementById('go-to-top');
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        goToTopButton.style.display = "block";
    } else {
        goToTopButton.style.display = "none";
    }
};
</script>

</body>
</html>
