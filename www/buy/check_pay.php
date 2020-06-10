<?php
	$card_number = filter_var(trim($_POST['card_number']), FILTER_SANITIZE_STRING);
	$month_year = filter_var(trim($_POST['month_year']), FILTER_SANITIZE_STRING);
	$CVC2 = filter_var(trim($_POST['CVC2']), FILTER_SANITIZE_STRING);
	$name_card = filter_var(trim($_POST['name_card']), FILTER_SANITIZE_STRING);
	
	//Получение открытого ключа сервера
	$mysql = new mysqli('localhost', 'root', '', 'bank');
	$mysql->query("SET NAMES 'utf8'");
	$search_key = $mysql->query("SELECT * FROM `rsa_keys`");
	$keys_server = $search_key->fetch_assoc();
	$public_key_server = $keys_server['public'];
	//Отправляем логин и ищем пользователя
	
	$result = $mysql->query("SELECT * FROM `bank_accounts` WHERE `card_number` = '$card_number'");
	$user = $result->fetch_assoc();
	if(count($user) == 0) {
		//header('Location: pay.order.php');
		echo "Карта не найдена";
		exit();
	}
	else{
		//Получение закрытого ключа сервера
		$private_key_server = $keys_server['private'];
		
		$month_year_server = $user['month/year'];
		$CVC2_server = $user['cvc2'];
		$name_card_check = $user['name_card'];
		
		$month_year_server = base64_decode($month_year_server);
		$CVC2_server = base64_decode($CVC2_server);
		
		openssl_private_decrypt($month_year_server,$month_year_check,$private_key_server);
		openssl_private_decrypt($CVC2_server,$CVC2_check,$private_key_server);
		
		if ($month_year != $month_year_check || $CVC2 != $CVC2_check || $name_card != $name_card_check){
			echo "Неверные данные";
			exit();
		}
		else{
			$mysql_shop = new mysqli('localhost', 'root', '', 'shop');
			$mysql_shop->query("SET NAMES 'utf8'");
			$id_person = $_COOKIE['id_person'];
			$result_order = $mysql_shop->query("SELECT * FROM `orders` WHERE `id_person` = '$id_person' AND `payment_method` = 'online' AND `pay_status` = 'Не оплачен'");
			$row_order = $result_order->fetch_assoc();
			$price_order = $row_order['price_order'];
			$id_order = $row_order['id_order'];
			
			$balance = $user['balance'];
			if ($balance >= $price_order){
				$balance = $balance - $price_order;
				$mysql->query("UPDATE `bank_accounts` SET `balance` = '$balance' WHERE `card_number` = '$card_number'");
				
				$result = $mysql->query("SELECT * FROM `bank_accounts` WHERE `id_account` = '1'");
				$shop = $result->fetch_assoc();
				$balance_shop = $shop['balance'];
				$balance_shop = $balance_shop + $price_order;
				$mysql->query("UPDATE `bank_accounts` SET `balance` = '$balance_shop' WHERE `id_account` = '1'");
				
				$mysql_shop->query("UPDATE `bank_account` SET `balance` = '$balance_shop' WHERE `id_bank_account` = '1'");
				
				$pay_status = "Оплачено";
				$mysql_shop->query("UPDATE `orders` SET `pay_status` = '$pay_status' WHERE `id_order` = '$id_order'");
			}
			else {
				echo "На счете недостаточно средств";
				exit();
			}
		}
	}
	$mysql->close();
	$mysql_shop->close();
	header('Location: pay_success.php');
?>