<?php
session_start();
session_unset();
session_destroy();

// Start a fresh session to store the flash message
session_start();
$_SESSION['flash_logout'] = "You have successfully logged out.";

// Redirect to login page
header("Location: login.php");
exit();
