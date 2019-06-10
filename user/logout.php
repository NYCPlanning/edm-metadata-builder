<?php
// Initialize the session.
session_start();
// Getting the absolute path
$path;
if ($_SERVER['SERVER_NAME'] === "localhost") {
  $path = 'http://localhost:8888/Metadata';
} else {
  $path = $_SERVER['SERVER_NAME'];
}
// Unset all of the session variables.
unset($_SESSION['user']);
unset($_SESSION['type']);
// Finally, destroy the session.
session_destroy();

// Include URL for Login page to login again.
header('location: '.$path.'/Main.php');
exit();
?>
