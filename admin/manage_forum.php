<?php 
include '../templates/header.php';
include '../php/database.php'; // Database connection

session_start(); 

// Check if the user is an admin
if (!isset($_SESSION['user']['username']) || $_SESSION['user']['role'] !== 'admin') {
    // If the user is not logged in or not an admin, redirect to the login page
    header("Location: login.php");
    exit();
}

// Handle deletion of a post
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_post_id'])) {
    $delete_post_id = $_POST['delete_post_id'];
    
    // Delete the post and its replies
    $stmt = $conn->prepare("DELETE FROM forum_posts WHERE id = ?");
    $stmt->bind_param("i", $delete_post_id);
    if ($stmt->execute()) {
        echo "<p>Post deleted successfully.</p>";
    } else {
        echo "<p>Error deleting post: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

// Fetch posts from the database
// Fetch forum posts from the database
$sql = "SELECT fp.*, u.username FROM forum_posts fp LEFT JOIN users u ON fp.user_id = u.id ORDER BY fp.created_at DESC";
$forumPosts = $conn->query($sql);

?>

<section class="admin-forum">
    <h2>Manage Forum Discussions</h2>

    <!-- Display all posts with a delete option -->
    <!-- Manage Forum Section -->
<section>
    <h2>Manage Forum Discussions</h2>
    <div class="forum-posts">
        <?php if ($forumPosts && $forumPosts->num_rows > 0): ?>
            <?php while ($post = $forumPosts->fetch_assoc()): ?>
                <article class="post-card">
                    <div class="post-header">
                        <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                        <p><strong>Posted by:</strong> <?php echo htmlspecialchars($post['username']); ?> on <?php echo $post['created_at']; ?></p>
                    </div>
                    <div class="post-body">
                        <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                    </div>
                    <!-- Delete post form -->
                    <form action="manage_forum.php" method="POST" style="display:inline;">
                        <input type="hidden" name="delete_post_id" value="<?php echo $post['id']; ?>">
                        <button type="submit" class="btn" onclick="return confirm('Are you sure you want to delete this post?');">Delete Post</button>
                    </form>
                </article>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No posts yet.</p>
        <?php endif; ?>
    </div>
</section>

</section>

<!-- Go to Top Button -->
<a href="#" class="go-to-top" id="go-to-top">
    <i class="fas fa-arrow-up"></i>
</a>

<?php
include '../templates/footer.php';
?>

<style>
/* General Styling */
.admin-forum {
    max-width: 800px;
    margin: auto;
    padding: 20px;
    font-family: Arial, sans-serif;
}

.admin-forum h2 {
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

.post-header {
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
    margin-bottom: 10px;
}

.post-header h3 {
    margin: 0;
    font-size: 1.5rem;
    color: #333;
}

.post-header p {
    margin: 5px 0;
    color: #777;
}

.post-body {
    margin-bottom: 10px;
}

/* Button Styles */
.btn {
    background-color: #f44336; /* Red color */
    color: white;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    border-radius: 5px;
}

.btn:hover {
    background-color: #e53935; /* Darker red */
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
