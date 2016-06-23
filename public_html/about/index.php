<?php
	include('../../include/basic.php');
	include('../../include/postList_class.php');
	//show index page with all blog titles, part of the body text and a read more link
	$layout = new Layout('..');

	$layout->printHeader('about');
	echo <<<HTML
	<article>
		<h2>About</h2>
		<p>内山達也レアンドロはブラジルのサンパウロ州で生まれ、育ち、現在10年以上日本在住しています。</p>
		<p>Leandro Tatsuya Utiyama, born and raised in São Paulo, Brazil. Now living in Japan for more than 10 years.</p>
		<p>興味・趣味(Interest/Hobby)<br>
				PHP<br>
				電子工作<br>
			写真</p>

		<p>言語(Languages)<br>
				ポルトガル語（母国語）(Portuguese)<br>
				英語（能弁）(English)<br>
			日本語（能力試験２級収得者）(Japanese)</p>
		<p>資格(Certifications)<br>
				日本語能力試験（Japanese Language Proficiency Test）2級<br>
				PHP5技術者認定試験初級<br>
		</p>
		<p>学歴(School Background)<br>
				UNIP Interativa 大卒情報処理(2年)<br>
				ウェブグラフィクス（Photoshop Illustrator)ヒューマンアカデミー<br>
				PHP独学<br>
			HTML/CSS独学
		</p>
	</article>

	<article>
		<div id="about_sns">
		<h2>Leandro Uti's Social Network</h2>
		<ul>
		<li><a href="https://www.twitter.com/L_utiyama/"><img src="../asset/image/TwitterLogo_50px.png" alt="Twitter" style="vertical-align:middle">@L_utiyama</a></li>
		<li><a href="https://www.github.com/leandrouti/"><img src="../asset/image/github_50px.png" alt="Github" style="vertical-align:middle">leandrouti</a></li>

		</ul>
		</div>
		</article>
HTML;
	$layout->printFooter();
?>
