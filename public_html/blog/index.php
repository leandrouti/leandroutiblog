<?php

	include('../../include/basic.php');
	include('../../include/postList_class.php');
	include('../../include/post_class.php');
	//show index page with all blog titles, part of the body text and a read more link
	$layout = new Layout('..');

	$layout->printHeader('Blog');

	$titleList = PostList::getTitleList();

	mb_internal_encoding('UTF-8');
	foreach($titleList as $id => $title){
		$post = new Post($id);

		if($post->getPublic() > 0){
			$abstract = mb_substr($post->getText(), 0, 30);
			$date = $post->getDate("date");
			$html = <<<HTML
			<article>
			<h2>{$title}</h2>
			<p class="date">{$date}</p>
			<p>{$abstract}...</p>
			<p class="continue_read"><a href="showpost.php?p_id={$id}">続き…</a></p>
			</article>
HTML;

		echo $html;
		}
	}

	$layout->printFooter();
?>
