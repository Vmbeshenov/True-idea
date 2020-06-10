<?php
	$id_book_to_del = $_POST['id_book_to_del'];
	$id_person = $_COOKIE['id_person'];
	$mysql = new mysqli('localhost', 'root', '', 'shop');
	$mysql->query("SET NAMES 'utf8'");
	$result_del = $mysql->query ("SELECT * FROM `basket` WHERE `id_person` = '$id_person' AND `id_book` = '$id_book_to_del'");
	$book_in_basket_del = $result_del->fetch_assoc();
	if($book_in_basket_del['number'] != 1) {		
		$mysql->query("UPDATE `basket` SET `number` = (`number` - '1') WHERE `id_person` = '$id_person' AND `id_book` = '$id_book_to_del'");
	}
	$mysql->close();
	header('Location: /buy/basket.php');
?>