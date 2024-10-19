<?php
session_start();
include '../php/database.php';

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: ../php/login.php");
    exit;
}

// Get the user ID from the query string
$user_id = $_GET['id'];

// Delete the user
$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    // Redirect to dashboard after deletion
    header("Location: ../admin/dashboard.php");
    exit;
} else {
    echo "Failed to delete user.";
}

$stmt->close();
$conn->close();
?>
