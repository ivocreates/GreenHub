<?php
session_start();
include '../php/database.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['post-title'];
    $content = $_POST['post-content'];
    $username = $_SESSION['user']['username']; // Assuming the user is logged in

    // Insert the new post into the database
    $sql = "INSERT INTO posts (title, content, username, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $title, $content, $username);

    if ($stmt->execute()) {
        header("Location: forum.php"); // Redirect back to the forum after successful post
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
