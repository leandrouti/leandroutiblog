<?php

	include('../../include/basic.php');

	//show index page with all blog titles, part of the body text and a read more link
	session_start();
	$token = hash("md5", uniqid());
	$_SESSION['token'] = $token;

	if(!empty($_GET['lang'])){
		switch($_GET['lang']){
			case 'ja' :
				$lang = 'ja';
			break;
			case 'br' :
				$lang = 'br';
			break;
			case 'en' :
				$lang = 'en';
			break;

			default:
				$lang = 'en';
		}
	}else{
		$lang = 'en';
	}

	$template = array();
	$template['ja']['html_tag'] = 'lang="ja"';
	$template['br']['html_tag'] = 'lang="pt-BR"';
	$template['en']['html_tag'] = 'lang="en-US"';

	$template['ja']['mail_txt'] = 'メール：';
	$template['br']['mail_txt'] = 'Email: ';
	$template['en']['mail_txt'] = 'Email: ';

	$template['ja']['msg_txt'] = 'メッセージ：';
	$template['br']['msg_txt'] = 'Mensagem: ';
	$template['en']['msg_txt'] = 'Message: ';

	$template['ja']['submit_btn'] = '送信';
	$template['br']['submit_btn'] = 'Enviar';
	$template['en']['submit_btn'] = 'Send';

	$layout = new Layout('..');
	$layout->printHeader('contact');
?>
	<div class="contact_form">
		<form action="send_mail.php" method="POST">
			<p><?php echo $template[$lang]['mail_txt']; ?> <input type="email" name="mail_addr" class="input_mail"></p>
			<p><?php echo $template[$lang]['msg_txt'] ?> <br><textarea name="mail_msg" class="textarea_msg"></textarea></p>
			<input type="hidden" name="token" value="<?php echo $token; ?>">
			<input type="hidden" name="lang" value="<?php echo $lang; ?>">
			<p><input type="submit" value="<?php echo $template[$lang]['submit_btn']; ?>"></p>
		</form>
	</div>
<?php
	$layout->printFooter();
?>
