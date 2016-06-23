<?php
	require('../login_function.php');
	require('../basic.php');
	require('../../../include/login.php');

	sec_session_start();
	$page_title = 'Modify Post';
		if(login_check($pdo)){
			printHeader($page_title, '..');
			if(!empty($_GET['p_id']) && is_numeric($_GET['p_id'])){
				require('../../../include/post_class.php');
				$id = $_GET['p_id'];
				$post = new Post($id);

				$html = '<form action="process_modify_post.php" method="post">';
				$html .= '<p><label for="p_title">Title:</label></p>';
				$html .= '<p><input type="text" name="p_title" id="in_p_title" value="' . $post->getTitle() . '"></p>';
				$html .= '<p><label for="tx_p_text">Text:</label></p>';
				$html .= '<p><textarea name="tx_p_text" id="tx_p_text">' . $post->getText() . '</textarea></p>';

				$checked = ($post->getPublic() == 0) ? "" : "checked";
				$html .= '<p>Make Public<input type="checkbox" name="public" value="public" ' . $checked . '></p>';
				$html .= '<input type="hidden" name="p_id" value="' . $id . '">';
				$html .= '<p><input type="submit" name="submit" value="Modify Post"></p>';
				$html .= '</form>';

				echo $html;

			}else{
				echo "<h1>Error could not find this ID</h1>";
			}
			printFooter();
		}else{
			printHeader($page_title, '..');
			echo "<h1>You are not allowed to view this page</h1>";
			printFooter();
		}
?>
