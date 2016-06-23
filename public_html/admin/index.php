<?php
	//this will be the entrance, where users authenticate
	require('login_function.php');
	require('basic.php');
	require('../../include/login.php');

	sec_session_start();

	if(login_check($pdo)){
		header('Location: ./adm_index.php');
	}else{
		printHeader('Login Page', '.');
		if(isset($_GET['error'])){
			$error = $_GET['error'];
		}else{
			$error = 0;
		}

		if($error == 1){
			$err_msg = "<p>Could not login.</p>";
		}else{
			$err_msg = '';
		}
?>
	<?php echo $err_msg; ?>
	<form action="process_login.php" method="post">
		<p>Email: <input type="email" name="email" id="email"></p>
		<p>Password: <input type="password" name="password" id="password"></p>
		<p><input type="submit" name="submit" value="Login"></p>
	</form>

	<p><a href="../index.php">Go to Main Page</a></p>

<?php
		printFooter();
	}

?>
