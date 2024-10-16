<?php
// Include the session management logic
include '../php/session_manager.php';

// Your existing code...
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - GreenHub</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script defer src="../js/script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="header-content">
            <a href="../pages/index.php" class="logo">GreenHub</a>
            <div class="menu-toggle" id="mobile-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
        <nav id="navbar">
            <ul>
                <li><a href="../pages/index.php">Home</a></li>
                <li><a href="../pages/eco-tips.php">Eco-Tips</a></li>
                <li><a href="../pages/renewable-energy.php">Renewable Energy</a></li>
                <li><a href="../pages/sustainable-products.php">Sustainable Products</a></li>
                <li><a href="../pages/community.php">Community</a></li>
                <li><a href="../pages/resources.php">Resources</a></li>
                <li><a href="../pages/contact.php">Contact Us</a></li>
                <?php if(isset($_SESSION['user'])): ?>
                    <li><a href="../php/profile.php">Profile</a></li>
                    <li><a href="../php/logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="../php/login.php">Login</a></li>
                    <li><a href="../php/signup.php">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
