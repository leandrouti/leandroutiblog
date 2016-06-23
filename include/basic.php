<?php

	class Layout{
		private $root;
		private $link_list;
		private $css_path;
		private $img_path;
		private $js_path;

		public function __construct($root){
			$this->root = $root;
			$this->link_list = array();
			$this->link_list['HOME'] = $this->root . '/index.php';
			$this->link_list['BLOG'] = $this->root . '/blog/index.php';
			$this->link_list['PROJECT'] = $this->root . '/project/index.php';
			$this->link_list['PHOTO'] = $this->root . '/photo/index.php';
			$this->link_list['CONTACT'] = $this->root . '/contact/index.php';
			$this->link_list['ABOUT'] = $this->root . '/about/index.php';

			$this->css_path = "{$this->root}/asset/css/main.css";
			$this->img_path = "{$this->root}/asset/image/";
			$this->js_path = "{$this->root}/asset/js/";
		}

		public function printHeader($pageTitle = '', $meta = ''){
			include_once("analyticTracking.php");
			$title = 'leandrouti.net';
			//$title .= ($pageTitle != '') ? " | {$pageTitle}" : '';
			$selected = '';
			if($pageTitle != ''){
				$title .= " | {$pageTitle}";

			}
			$meta = "<meta charset=\"utf-8\">\n";
			$meta .= "<meta name=\"author\" content=\"Leandro Tatsuya Utiyama\">\n";
			$meta .= "<meta name=\"description\" content=\"Leandro Tatsuya Utiyama personal website\">\n";
			if(is_array($meta)){


				foreach($meta as $name => $content){
					$meta .= "<meta name=\"{$name}\" content=\"{$content}\">\n";
				}
			}

			$menu = '';
			foreach($this->link_list as $name => $url){
				if(strtoupper($pageTitle) == $name){
					$selected = ' class="selected"';
				}else{
					$selected = '';
				}
				$menu .= "<li><a href=\"{$url}\" {$selected}>{$name}</a></li>\n";
			}

$header =<<<HTML
<!DOCTYPE html>
<html lang='ja'>
	<head>
		<title>{$title}</title>
		{$meta}
		<link rel="stylesheet" href="{$this->css_path}">
	</head>
	<body>
	{$analytics}
	<div id="container">
		<header>
			<div id="title">
				<div id="logo">
					<img src="{$this->img_path}luti-logo_rasterized.png" alt="leandrouti.net-logo" />
				</div>
				<h1>Leandrouti's website</h1>
			</div>

			<nav>
				<ul>
					{$menu}
				</ul>
			</nav>
		</header>
		<div id="content">
HTML;
			echo $header;
		}

        public function printFooter(){
            $nowY = date('Y');
            $footer = "</div><!-- div_content -->\n";
			$footer .= '<div class="side_bar"><a class="twitter-timeline"  href="https://twitter.com/L_utiyama" data-widget-id="734736180734922752">@L_utiyamaさんのツイート</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div>';
			$footer .= "<footer><p><small>&copy;Copyright 2012 ~ {$nowY} all rights reserved.</small></p></footer>\n";
			$footer .= "</div><!-- div_container -->\n";
			$footer .= '</body></html>';

            echo $footer;
        }
	}

?>
