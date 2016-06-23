<?php

	include('../../include/basic.php');
	include('../../include/postList_class.php');
	include('../../include/post_class.php');
	//show the basic template, and the post text;

	if(!empty($_GET['p_id']) && is_numeric($_GET['p_id'])){
		//get post by post id
		$layout = new Layout('http://leandrouti.net');
		$layout->printHeader();

		$p_id = $_GET['p_id'];
		$post = new Post($p_id);
		echo '<article class="post_body">';
		echo '<h2>' . $post->getTitle() . '</date></h2>';
		echo '<date>' . $post->getDate("date") . '</date>';
		echo '<p>' . $post->getText() . '</p>';
		echo '<p><a href="index.php">戻る</a></p>';
		echo '</article>';
		$layout->printFooter();
	}else{
		//go to sorry page
		header('Location: ../404.php');
	}
?>
