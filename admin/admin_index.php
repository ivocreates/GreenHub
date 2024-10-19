<?php 
include '../templates/header.php';
session_start(); 

// Check if the user is an admin
if (!isset($_SESSION['user']['username']) || $_SESSION['user']['role'] !== 'admin') {
    // If the user is not logged in or not an admin, redirect to the login page
    header("Location: login.php");
    exit();
}
?>

<section class="admin-dashboard">
    <h2>Admin Dashboard</h2>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['user']['username']); ?>! Use the links below to manage the site.</p>
    
    <div class="admin-links">
        <a href="manage_users.php" class="admin-link">Manage Users</a>
        <a href="manage_articles.php" class="admin-link">Manage Articles</a>
        <a href="manage_forum.php" class="admin-link">Manage Forums</a>
    </div>
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
.admin-dashboard {
    max-width: 800px;
    margin: auto;
    padding: 20px;
    font-family: Arial, sans-serif;
    text-align: center;
}

.admin-dashboard h2 {
    color: #333;
}

.admin-links {
    margin-top: 20px;
}

.admin-link {
    display: inline-block;
    margin: 10px 15px;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s;
}

.admin-link:hover {
    background-color: #45a049;
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
