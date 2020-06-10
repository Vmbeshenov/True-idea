<?php
	include "../RSA/Enc.class.php";
	$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
	$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
		
	//Получение открытого ключа сервера
	$mysql = new mysqli('localhost', 'root', '', 'shop');
	$mysql->query("SET NAMES 'utf8'");
	$search_key = $mysql->query("SELECT * FROM `rsa_keys`");
	$keys_server = $search_key->fetch_assoc();
	$public_key_server = $keys_server['public'];
	//Отправляем логин и ищем пользователя
	$result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login'");
	$user = $result->fetch_assoc();
	if(count($user) == 0) {
		echo "Пользователь не найден";
		exit();
	}
	else{
		//Получение закрытого ключа сервера
		$private_key_server = $keys_server['private'];
		$password_server = $user['password'];
		$password_server = base64_decode($password_server);
		openssl_private_decrypt($password_server,$password_check,$private_key_server);
		if ($password != $password_check){
			echo "Неверный логин и/или пароль";
			exit();
		}	
	}
	setcookie('user', $user['login'], time() + (3600 * 24), "/");
	setcookie('id_person', $user['id'], time() + (3600 * 24), "/");
	$mysql->close();
	header('Location: /main');
?>