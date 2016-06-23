<?php
	require('../login_function.php');
	require('../basic.php');
	require('../../../include/login.php');

	sec_session_start();
	$page_title = 'Modify Post';
		if(login_check($pdo)){
			printHeader($page_title, '..');
			if(!empty($_POST['p_id']) && is_numeric($_POST['p_id']) && !empty($_POST['p_title']) || !empty($_POST['tx_p_text'])){
				require('../../../include/post_class.php');
				$title = $_POST['p_title'];
				$text = $_POST['tx_p_text'];
				$id = $_POST['p_id'];
				$public = (isset($_POST['public']))? 1 : 0;

				$post = new Post($id);

				$post->setTitle($title);
				$post->setText($text);
				$post->setPublic($public);

				if($post->save()){
					echo "<h2>Post Modified Successfully.</h2>";
					echo '<p><a href="index.php">Go back to Admin Post Page</a></p>';
				}

			}else{
				echo "<h1>Post title or post text is not setted</h1>";
			}
			printFooter();
		}else{
			printHeader($page_title, '..');
			echo "<h1>You are not allowed to view this page</h1>";
			printFooter();
		}
?>
