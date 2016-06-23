<?php
	include('../include/basic.php');
	include('../include/post_class.php');
	include('../include/postList_class.php');
	$data = PostList::getTitleList();
	$layout = new Layout('.');

	$layout->printHeader('home');
	//ar_dump($data);

	echo "<p>2016-05-04<a href=\"./blog/index.php\">ブログに新しい記事があります。</a></p>";
	echo "<p>2016-05-14<a href=\"./about/index.php\">ABOUTページに変更。</a></p>";
	echo "<p>2016-05-15<a href=\"./photo/index.php\">PHOTOページに変更。</a></p>";
	echo "<p>2016-05-15<a href=\"./blog/index.php\">ブログに新しい記事があります。</a></p>";

	$layout->printFooter();
?>
