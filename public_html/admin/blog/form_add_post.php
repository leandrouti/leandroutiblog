<?php
	require('../login_function.php');
	require('../basic.php');
	require('../../../include/login.php');

	sec_session_start();
	$page_title = 'Add post';
	if(login_check($pdo)){
		printHeader($page_title, '..');
		echo "<h1>ADMIN {$page_title}</h1>";

		$html = <<<HTML
		<form action="process_add_post.php" method="post">
		<p><label for="p_title">Title:</label></p>
		<p><input type="text" name="p_title" id="in_p_title"></p>
		<p><label for="tx_p_text">Text:</label></p>
		<p><textarea name="tx_p_text" id="tx_p_text"></textarea></p>
		<p>Make Public<input type="checkbox" name="public" value="public"></p>
		<p><input type="submit" name="submit" value="Add Post"></p>
		</form>
HTML;

		echo $html;
		printFooter();
	}else{
		printHeader($page_title, '..');
		echo "<h1>You are not allowed to view this page</h1>";
		printFooter();
	}
?>
