<?php
session_start();
include '../php/database.php';

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: ../php/login.php");
    exit;
}

// Get user id from the query string
$user_id = $_GET['id'];

// Fetch the user's information
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Handle form submission for updating user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Update password only if provided
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
        $stmt->bind_param("sssi", $username, $email, $hashed_password, $user_id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $username, $email, $user_id);
    }

    if ($stmt->execute()) {
        // Redirect to dashboard after update
        header("Location: ../admin/dashboard.php");
        exit;
    } else {
        $error_message = "Failed to update user.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - GreenHub</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<main class="form-container">
    <h2>Edit User</h2>

    <?php if (!empty($error_message)): ?>
        <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form action="edit_user.php?id=<?php echo $user_id; ?>" method="POST">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>

        <div class="form-group">
            <label for="password">New Password (leave empty to keep current):</label>
            <input type="password" id="password" name="password">
        </div>

        <button type="submit" class="btn">Update User</button>
        <a href="../admin/dashboard.php" class="btn">Cancel</a>
    </form>
</main>

</body>
</html>
