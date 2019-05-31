<?php
	// When users click on the verification email their account becomes verified.
	include 'config.php';
	// Getting the absolute path
	$path;
	if ($_SERVER['SERVER_NAME'] === "localhost") {
	  $path = 'http://localhost:8888/Metadata';
	} else {
  	$path = $_SERVER['SERVER_NAME'];
	}
	if(isset($_GET['vkey'])) {
		$vkey = $_GET['vkey'];

		$query = "SELECT verified, vkey FROM users WHERE verified = '0' AND vkey = $1 LIMIT 1";

		$result = pg_query_params($db, $query, array($vkey));

		if($result) {
			// Validate The Email
			pg_query_params($db, "UPDATE users SET verified = 1 WHERE vkey = $1", array($vkey));

			session_start();
			$_SESSION['message'] = 'Your Email has been verified, you may now login.';
			// Redirect to login page
			header('location: '.$path.'/Main.php');
		} else {
			echo "This account is invalid or already verified";
		}
	} else {
		die("Something went wrong!");
	}
?>
