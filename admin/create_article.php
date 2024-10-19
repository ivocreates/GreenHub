<?php
session_start();
include '../php/database.php'; // Include your database connection

// Check if the admin is logged in
if (!isset($_SESSION['user'])) {
    header("Location: ../admin/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Handle image upload
    $image = $_FILES['image'];
    $imagePath = '';

    if ($image['error'] == UPLOAD_ERR_OK) {
        // Set the destination for the uploaded image
        $targetDir = '../images/';
        $imagePath = $targetDir . basename($image['name']);
        
        // Move the uploaded file to the target directory
        if (move_uploaded_file($image['tmp_name'], $imagePath)) {
            // Insert the new article into the database
            $stmt = $conn->prepare("INSERT INTO articles (title, content, image) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $title, $content, $imagePath);
            
            if ($stmt->execute()) {
                header("Location: ../admin/manage_articles.php"); // Redirect to article management page after successful insertion
                exit;
            } else {
                $error_message = "Failed to create article.";
            }
        } else {
            $error_message = "Failed to upload image.";
        }
    } else {
        $error_message = "Image upload error.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Article</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<main class="form-container">
    <h2>Create New Article</h2>

    <?php if (isset($error_message)): ?>
        <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>

    <form action="create_article.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="10" required></textarea>
        </div>

        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>

        <button type="submit" class="btn">Create Article</button>
        <a href="manage_articles.php" class="btn">Cancel</a>
    </form>
</main>

</body>
</html>
