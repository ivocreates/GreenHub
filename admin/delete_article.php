<?php
session_start();
include '../php/database.php'; // Include your database connection

if (!isset($_SESSION['user'])) {
    header("Location: ../admin/login.php");
    exit;
}

$article_id = $_GET['id'];

// Delete the article
$stmt = $conn->prepare("DELETE FROM articles WHERE id = ?");
$stmt->bind_param("i", $article_id);
$stmt->execute();
$stmt->close();

header("Location: ../admin/manage_articles.php");
exit;
?>
