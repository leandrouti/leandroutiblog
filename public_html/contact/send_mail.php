<?php
	include('../../include/basic.php');
	session_start();

	$to = 'admin@leandrouti.net';

	$template = array();
	$template['ja']['error'] = 'メッセージの送信ができませんでした。';
	$template['br']['error'] = 'Não foi possível enviar a mensagem.';
	$template['en']['error'] = 'Your message could not be sent.';

	$template['ja']['mail_empty'] = 'あなたのメールアドレスを記入してください。';
	$template['br']['mail_empty'] = 'Por favor insira o seu endereço de email.';
	$template['en']['mail_empty'] = 'Please fill in your email address.';

	$template['ja']['msg_empty'] = 'メッセージを記入してください。';
	$template['br']['msg_empty'] = 'Por favor insira a mensagem.';
	$template['en']['msg_empty'] = 'Please fill in the message.';

	$template['ja']['mb_lang'] = 'Japanese';
	$template['br']['mb_lang'] = 'English';
	$template['en']['mb_lang'] = 'English';

	$template['ja']['send_success'] = 'メッセージを送信しました。';
	$template['br']['send_success'] = 'Mensagem enviada.';
	$template['en']['send_success'] = 'Message sent.';

	$layout = new Layout('..');
	$layout->printHeader('contact');

	$lang = (!empty($_POST['lang'])) ? $_POST['lang'] : 'en';

	if(!empty(trim($_POST['mail_msg']))){
		$msg = htmlentities($_POST['mail_msg'], ENT_QUOTES, "UTF-8");
	}else{
		echo $template[$lang]['msg_empty'];
	}

	if(!empty(($_POST['mail_addr']))){
		$mail = filter_var($_POST['mail_addr'], FILTER_VALIDATE_EMAIL);
	}else{
		echo $template[$lang]['mail_empty'];
	}

	if(empty($_SESSION['token']) || $_SESSION['token'] != $_POST['token']){
		echo $template[$lang]['error'];
	}else{
		if(!empty($mail) && !empty($msg)){
			//mb_language($template[$lang]['mb_lang']);
			mb_language(Japanese);
			mb_internal_encoding('UTF-8');

			$header = "From: " . $mail;
			$subject = "From contact page. " . $lang;

			if(mb_send_mail($to, $subject, $msg, $header)){
				echo $template[$lang]['send_success'];
			}else{
				echo $template[$lang]['error'];
			}
		}
	}

	$layout->printFooter();
?>
