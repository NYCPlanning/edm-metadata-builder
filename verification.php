<?php
	// When users click on the verification email their account becomes verified. 
	include 'config.php';
	if(isset($_GET['vkey'])) {
		$vkey = pg_escape_string($_GET['vkey']);
		$query = "SELECT verified, vkey FROM users WHERE verified = '0' AND vkey = '$vkey' LIMIT 1";
		$result = pg_query($query);

		if($result) {
			// Validate The Email
			pg_query("UPDATE users SET verified = 1 WHERE vkey = '$vkey'");
			session_start();
			$_SESSION['message'] = 'Your Email has been verified, you may now login.';
			header('location: login.php');
		} else {
			echo "This account is invalid or already verified";
		}
	} else {
		die("Something went wrong!");
	}
?>
