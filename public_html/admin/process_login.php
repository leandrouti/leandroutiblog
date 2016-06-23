<?php
	include('login_function.php');
	require('../../include/login.php');
	sec_session_start();
	if(isset($_POST['email'], $_POST['password'])){
		$email = $_POST['email'];
		$password = $_POST['password'];

		if(login($email, $password, $pdo)){
			header('Location: ./adm_index.php');
		}else{
			header('Location: ./index.php?error=1');
		}
	}else{
		echo 'Invalid Request';
	}

?>
