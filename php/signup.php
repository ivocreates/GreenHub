<?php
session_start();
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process your signup form data here
    // Assuming the signup process is successful, redirect to login.php

    // Example of signup process:
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Example insert query (you need to sanitize and hash password properly)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        // Redirect to login page after successful signup
        header("Location: login.php");
        exit;
    } else {
        // Handle signup failure
        $error_message = "Signup failed. Please try again.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - GreenHub</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <?php include '../templates/header.php'; ?>

    <main>
        <section class="signup-form-section">
            <h2>Create a New Account</h2>

            <?php if (!empty($error_message)): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <form action="signup.php" method="post" class="signup-form">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn">Sign Up</button>
                <p>Already have an account? <a href="login.php">Login here</a>.</p>
            </form>
        </section>
    </main>

    <?php include '../templates/footer.php'; ?>

</body>
</html>
