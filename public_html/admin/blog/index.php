<?php
//This will be the main page for logged users.
	require('../login_function.php');
	require('../basic.php');
	require('../../../include/login.php');
	require('../../../include/postList_class.php');
	require('../../../include/post_class.php');

	sec_session_start();

	$page_title = 'blog';
	if(login_check($pdo)){
		printHeader($page_title, '..');
		echo "<h1>ADMIN {$page_title}</h1>";
		echo "<p><a href=\"form_add_post.php\">Create Blog Post</a></p>";
		//show list of posts with edit and delete links
		//show a create new post with a link to form_add_post.php
		$postTitleList = PostList::getTitleList();

		$table = <<<HTML

		<table border="1">
		<tr><th>ID</th><th>Title</th><th>Public</th><th>Date</th><th>Modify</th></tr>
HTML;

		foreach($postTitleList as $id => $title){
			$post = new Post($id);
			$table .= "<tr><td>" . $id . "</td>";
			$table .= "<td>" . $post->getTitle() . "</td>";
			$pub = ($post->getPublic() == 0)? "Not Public" : "Public";
			$table .= "<td>" . $pub . "</td>";
			$table .= "<td>" . $post->getDate() . "</td>";
			$table .= '<td><a href="form_modify_post.php?p_id=' . $id . '">Modify</a></td>';
			$table .= '</tr>';
		}
		$table .= "</table>";

		echo $table;
		printFooter();
	}else{
		echo "<p>You are not allowed to view this page</p>";
		echo '<p><a href="../index.php">Go back</a></p>';
		printFooter();
	}

?>
