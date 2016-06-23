<?php
	require('../include/basic.php');

	$layout = new Layout('');

	$layout->printHeader();

	echo <<<HTML
	<h2>404 not found.</h2>
	<p>Ooops, sorry somehow the page you are looking was eaten away =).</p>
HTML;

	$layout->printFooter();
?>
