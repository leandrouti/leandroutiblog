<?php

	function printHeader($title = '', $root){

		$link_list = array();
		$link_list['HOME'] = $root . '/adm_index.php';
		$link_list['BLOG'] = $root . '/blog/index.php';
		$link_list['PROJECT'] = $root . '/project/index.php';
		$link_list['PHOTO'] = $root . '/photo/index.php';
		$link_list['ABOUT'] = $root . '/about/index.php';
		$link_list['LOGOUT'] =  $root . '/logout.php';
		$menu_list = '<div id="nav"><nav><ul id="menu">';
		foreach($link_list as $item => $url){
			$menu_list .= "<li><a href=\"{$url}\">{$item}</a></li>\n";
		}
		$menu_list .= '</ul></nav></div><!-- nav -->';

		if(array_key_exists(strtoupper($title), $link_list)){
			$menu = $menu_list;
		}else{
			$menu = "";
		}


		$header  = <<<HTML
<!DOCTYPE html>
<html lang="ja">
<head>
	<title>{$title}</title>
	<meta charset="utf-8">
	<meta name="robots" content="noindex">
	<meta name="robots" content="nofollow">
	<meta name="robots" content="noarchive">
</head>
<body>
<div id="container">
{$menu}
HTML;
	echo $header . "\n";
	}

	function printFooter(){
		$footer = <<<HTML
</div><!-- container -->
</body>
</html>
HTML;
		echo $footer;
	}
?>
