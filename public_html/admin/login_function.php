<?php

	function sec_session_start(){
		$session_name = 'sec_session_id';
		$secure = false;
		$httpOnly = true;

		if(ini_set('session.use_only_cookies', 1) === FALSE){
			header('Location: error.php?err=Could not initiate a safe session(ini_set)');
			exit();
		}

		//Gets current cookies params.
		$cookieParams = session_get_cookie_params();
		session_set_cookie_params($cookieParams['lifetime'],
			$cookieParams['path'],
			$cookieParams['domain'],
			$secure,
			$httpOnly);

		//Sets the session name to the one set above.
		session_name($session_name);
		session_start(); //starts PHP session
		session_regenerate_id(true); //regenerated the session, delete the old one
	}

	function checkbrute($id, $pdo){
		//require('../../include/login.php');
		$now = time();
		//All login attempts are counted from the past 2 hours
		$valid_attempts = $now - (2 * 60 * 60);
		$stmt = $pdo->prepare("SELECT count(time) FROM login_attempts WHERE user_id = :user_id AND time > '{$valid_attempts}'");
		$stmt->bindParam(':user_id', $id, PDO::PARAM_INT);
		if($stmt->execute()){
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			if($result['count(time)'] >= 5){
				return true;
			}else{
				return false;
			}
		}else{
			die("Error: cannot access database");
		}
	}

	function login($email, $password, $pdo){
		//require('../../include/login.php');
		$sql = 'SELECT id, username, password FROM login where email = :email limit 1';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		if($stmt->execute()){
			if($result = $stmt->fetch(PDO::FETCH_ASSOC)){
				$user_id = $result['id'];
				$db_password = $result['password'];
				$username = $result['username'];

				//If the user exists we check if the account is locked from to many login attempts
				if(checkbrute($user_id, $pdo) == true){
					//Account is locked
					//Send an email to the user saying their account is locked
					//echo "Account is locked";
					return false;
				}else{
					//Check if the password in the database matches
					//The password the user submitted.
					if(password_verify($password, $db_password)){
						//Password is correct
						// Get the user-agent string of the suer.
						$user_browser = $_SERVER['HTTP_USER_AGENT'];
						//XSS protection as we might print this value
						$user_id - preg_replace("/[^0-9]+/","", $user_id);
						$_SESSION['user_id'] = $user_id;
						//XSS protection as we might print this value
						$username = preg_replace("/[^a-zA-z0-9_\-]+/","", $username);
						$_SESSION['username'] = $username;
						$_SESSION['login_string'] = hash('sha512', $db_password . $user_browser);
						//login successfull
						return true;

					}else{
						//Passwrod is not correct
						//We record this attempt in the database
						$now = time();
						$pdo->query("INSERT INTO login_attempts(user_id, time) VALUES('{$user_id}', '{$now}')");
						return false;
					}
				}
			}else{
				// No user exists
				return false;
			}
		}else{
			//Error PDO execute
			return false;
		}
	}

	function login_check($pdo){
		//require('../../include/login.php');

		if(isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])){
			$user_id = $_SESSION['user_id'];
			$login_string = $_SESSION['login_string'];
			$username = $_SESSION['username'];

			//Get the user-agent string
			$user_browser = $_SERVER['HTTP_USER_AGENT'];

			$stmt = $pdo->prepare('SELECT password FROM login WHERE id = :id LIMIT 1');
			$stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
			if($stmt->execute()){
				if($result = $stmt->fetch(PDO::FETCH_ASSOC)){
					$password = $result['password'];
					$login_check = hash('sha512', $password . $user_browser);

					if(hash_equals($login_check, $login_string)){
						//Logged in!!!!
						return true;
					}else{
						//not Logged in
						//$login_check and $login_string dont match
						return false;
					}
				}else{
					//not logged in
					//password not found under this id
					return false;
				}
			}else{
				//not logged in
				//could not make query
				return false;
			}
		}else{
			//Session variables are not set
			//not logged in
			return false;
		}
	}

	function esc_url($url){
		if($url == ''){
			return $url;
		}else{
			return filter_var(trim($url), FILTER_SANITIZE_URL);
		}
	}
?>
