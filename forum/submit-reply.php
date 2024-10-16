<?php
session_start();
include '../php/database.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_id = $_POST['post_id'];
    $content = $_POST['content'];
    $username = $_SESSION['user']['username']; // Assuming the user is logged in

    // Insert the new reply into the database
    $sql = "INSERT INTO replies (post_id, content, username, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $post_id, $content, $username);

    if ($stmt->execute()) {
        header("Location: post.php?id=" . $post_id); // Redirect back to the post
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
