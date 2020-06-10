<?php
	session_start ();
	if(isset($_POST["send"])){
		$name = htmlspecialchars ($_POST["name"]);
		$email = htmlspecialchars ($_POST["email"]);
		$subject = htmlspecialchars ($_POST["subject"]);
		$message = htmlspecialchars ($_POST["message"]);
		$_SESSION["name"] = $name;
		$_SESSION["email"] = $email;
		$_SESSION["subject"] = $subject;
		$_SESSION["message"] = $message;
		$error_name="";
		$error_email="";
		$error_subject="";
		$error_message="";
		$error = false;
		if($name == ""){
			$error_name = "Введите свое имя";
			$error = true;
		}
		if($email == "" || !preg_match("/@/", $email)){
			$error_email = "Введите корректный e-mail";
			$error = true;
		}
		if($subject == ""){
			$error_subject = "Введите тему сообщения";
			$error = true;
		}
		if($message == ""){
			$error_message = "Введите сообщение";
			$error = true;
		}
		if(!$error){
			$subject = "=?utf-8?B?".base64_encode($subject)."?=";
			$header = "From: $email\r\nReply-to: $email\r\nContent-type: text/plain; charset=utf-8\r\n";
			mail ($name, $subject, $message, $headers);
			header("Location: index.php");
			exit;
		}
	}
?>
<?php $title="Обратная связь"; require "../header/header.php"; ?>
<h2><span class="head_page_title">Обратная связь</span></h2>
<br />
<hr class="head_line"/>	
<div class="content" id="feedback_page">
<form name="feedback" action="" method="post">

	<input type="text" name="name" class="letter" id="letter_name_person" placeholder="Ваше имя" value="<?php echo $_SESSION["name"] ?>" /><br />
	<span style="color:red"><?=$error_name?></span><br />
	
	<input type="email" name="email" class="letter" id="letter_email_person" placeholder="e-mail" value="<?php echo $_SESSION["email"] ?>" /><br />
	<span style="color:red"><?=$error_email?></span><br />
	
	<input type="text" name="subject" class="letter" id="letter_topic" placeholder="Тема сообщения" value="<?php echo $_SESSION["subject"] ?>" /><br />
	<span style="color:red"><?=$error_subject?></span><br />
	
	<textarea name="message" id="letter_text" placeholder="Сообщение..." ><?php echo $_SESSION["message"] ?></textarea><br />
	<span style="color:red"><?=$error_message?></span><br />
	
	<input type="submit" name="send" id="letter_btn-send" value="Отправить" />
	
</form>
</div>
<?php require "../footer/footer.php"; ?>