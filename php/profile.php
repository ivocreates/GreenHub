<?php 
session_start();
include 'database.php';

// Ensure user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your styles.css -->
    <style>
        /* Custom styles for profile page */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .profile-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .profile-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 20px;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin-bottom: 20px;
            border: 3px solid #ddd; /* Border around profile pic */
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-details {
            margin-bottom: 20px;
        }

        .profile-details p {
            font-size: 18px;
            color: #333;
            margin: 5px 0;
        }

        .profile-details p strong {
            color: #2c3e50;
        }

        .profile-actions {
            margin-top: 20px;
        }

        .profile-actions a {
            display: inline-block;
            margin: 5px 10px;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .profile-actions a:hover {
            background-color: #2980b9;
        }

        .btn-secondary {
            background-color: #f39c12;
        }

        .btn-secondary:hover {
            background-color: #e67e22;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include '../templates/header.php'; ?>

    <div class="profile-container">
        <h2>User Profile</h2>

        <div class="profile-card">
            <div class="profile-image">
                <!-- Display profile image or a default image if the user doesn't have one -->
                <?php
                if (isset($user['profile_pic']) && !empty($user['profile_pic'])) {
                    echo '<img src="' . htmlspecialchars($user['profile_pic']) . '" alt="Profile Image">';
                } else {
                    echo '<img src="path/to/default-image.jpg" alt="Profile Image">';  // Replace with a default image
                }
                ?>
            </div>

            <div class="profile-details">
                <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                
                <!-- Check if bio exists before displaying it -->
                <p><strong>Bio:</strong> <?php echo isset($user['bio']) ? htmlspecialchars($user['bio']) : 'No bio set.'; ?></p>
            </div>

            <div class="profile-actions">
                <a href="edit-profile.php" class="btn btn-primary">Edit Profile</a>
                <a href="change-password.php" class="btn btn-secondary">Change Password</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include '../templates/footer.php'; ?>
</body>
</html>
