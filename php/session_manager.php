<?php
// Start the session first
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

// Session Configuration and Initialization




// Regenerate session ID to prevent fixation attacks (optional but recommended)
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id(true);
    $_SESSION['initiated'] = true;
}

// Debug: Print session contents (optional, for debugging purposes)
// print_r($_SESSION);
?>
