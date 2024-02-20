<?php
session_start();
// Destroy the session
session_destroy();
// Redirect to the home page
header('Location: homepage.php'); // Replace '/' with the path to your home page
exit;
?>
