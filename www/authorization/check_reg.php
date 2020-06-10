<?php
	include "../RSA/Enc.class.php";
	$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
	$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
	$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
	$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
	$password_2 = filter_var(trim($_POST['password_2']), FILTER_SANITIZE_STRING);
	
	if(mb_strlen($login) < 5 || mb_strlen($login) > 20) {
		echo "Недопустимая длина логина";
		exit();
	}
	else if(mb_strlen($name) < 3 || mb_strlen($name) > 20) {
		echo "Недопустимая длина имени";
		exit();
	}
	else if(mb_strlen($password) < 2 || mb_strlen($password) > 20) {
		echo "Недопустимая длина пароля (от 2 до 20 символов)";
		exit();
	}
	else if($password != $password_2) {
		echo "Пароли не совпадают";
		exit();
	}
		
	//Формирование ключей
	$key = Enc::get_keys($login);
	$public_key = $key['public'];
	//Получение открытого ключа сервера
	$mysql = new mysqli('localhost', 'root', '', 'shop');
	$mysql->query("SET NAMES 'utf8'");
	$search_key = $mysql->query("SELECT * FROM `rsa_keys`");
	$keys_server = $search_key->fetch_assoc();
	$public_key_server = $keys_server['public'];
	
	//Шифрование пароля с помощью открытого ключа сервера
	openssl_public_encrypt($password,$password_crip,$public_key_server);
	$password_crip = base64_encode($password_crip);
	//Отправка открытого ключа на сервер	
	$mysql->query("INSERT INTO `users` (`login`, `password`, `name`, `email`, `public_key`) VALUES('$login', '$password_crip', '$name', '$email', '$public_key') ");
	
	//Авторизация
	$result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login'");
	$user = $result->fetch_assoc();
	setcookie('user', $user['login'], time() + (3600 * 24), "/");
	setcookie('id_person', $user['id'], time() + (3600 * 24), "/");
	
	$mysql->close();
	header('Location: /main');
?>
