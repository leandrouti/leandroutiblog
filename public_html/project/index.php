<?php

	include('../../include/basic.php');
	include('../../include/postList_class.php');
	//show index page with all blog titles, part of the body text and a read more link
	$layout = new Layout('..');

	$layout->printHeader('Project');

	$layout->printFooter();
?>
