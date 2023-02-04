<?php
session_start();

// Clear the user's session
unset($_SESSION['user']);
session_destroy();

// Redirect the user to the login page
header("Location: login.php");
exit;
?>
