<?php
//This will be the main page for logged users.
	require('login_function.php');
	require('basic.php');
	require('../../include/login.php');
	sec_session_start();
	if(login_check($pdo)){
		printHeader('home', '.');
		echo 'user is logged in';
		echo '<p><a href="logout.php">Logout</a></p>';
		printFooter();
	}else{
		echo "<p>You are not allowed to view this page</p>";
		echo '<p><a href="./index.php">Go back</a></p>';
	}

?>
