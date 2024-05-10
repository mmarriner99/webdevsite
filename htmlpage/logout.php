<?php
session_start();
unset($_SESSION['username']); // Unsets the username session variable
header('Location: homepage.php'); // Redirects to the homepage
exit;