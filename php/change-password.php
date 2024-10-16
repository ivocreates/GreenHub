<?php
session_start();
include 'database.php';

// Ensure user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = $_POST['current_password'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    $user_id = $_SESSION['user']['id'];

    // Verify current password
    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    if (password_verify($current_password, $hashed_password)) {
        // Update with new password
        $stmt_update = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt_update->bind_param("si", $new_password, $user_id);
        if ($stmt_update->execute()) {
            echo "<p>Password changed successfully!</p>";
        } else {
            echo "<p>Error: " . $stmt_update->error . "</p>";
        }
    } else {
        echo "<p>Current password is incorrect.</p>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your styles.css -->
</head>
<body>
    <!-- Header -->
    <?php include '../templates/header.php'; ?>

    <div class="profile-container">
        <h2>Change Password</h2>

        <div class="profile-card">
            <!-- Change Password Form -->
            <form action="change-password.php" method="post">
                <label for="current_password">Current Password:</label>
                <input type="password" name="current_password" id="current_password" required>

                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" id="new_password" required>

                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <?php include '../templates/footer.php'; ?>
</body>
</html>
