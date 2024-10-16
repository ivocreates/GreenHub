<?php
// Start the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the homepage or login page
header("Location: ../pages/index.php"); // Change the location if you want to redirect to a login page
exit;
?>
