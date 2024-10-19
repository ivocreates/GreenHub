<?php
session_start();
include '../php/database.php'; // Include your database connection

if (!isset($_SESSION['user'])) {
    header("Location: ../admin/login.php");
    exit;
}

$article_id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->bind_param("i", $article_id);
$stmt->execute();
$article = $stmt->get_result()->fetch_assoc();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $imagePath = $article['image']; // Default to the existing image

    // Handle image upload if a new file was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $targetDir = "../images/"; // Specify your upload directory
        $imageName = basename($_FILES['image']['name']);
        $imagePath = $targetDir . $imageName;

        // Move the uploaded file to the target directory
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            $error_message = "Failed to upload the image.";
        }
    }

    // Update the article in the database
    $stmt = $conn->prepare("UPDATE articles SET title = ?, content = ?, image = ? WHERE id = ?");
    $stmt->bind_param("sssi", $title, $content, $imagePath, $article_id);
    
    if ($stmt->execute()) {
        header("Location: manage_articles.php");
        exit;
    } else {
        $error_message = "Failed to update article.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<main class="form-container">
    <h2>Edit Article</h2>

    <form action="edit_article.php?id=<?php echo $article_id; ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required>
        </div>

        <div class="form-group">
            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="10" required><?php echo htmlspecialchars($article['content']); ?></textarea>
        </div>

        <div class="form-group">
            <label for="image">Upload Image:</label>
            <input type="file" id="image" name="image" accept="image/*">
            <?php if ($article['image']): ?>
                <p>Current Image: <img src="../images/<?php echo htmlspecialchars($article['image']); ?>" alt="Current Article Image" width="100"></p>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn">Update Article</button>
        <a href="../admin/manage_articles.php" class="btn">Cancel</a>
    </form>
</main>

</body>
</html>
