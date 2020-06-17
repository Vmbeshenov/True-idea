<?php
	$id_book = $_POST['id_book'];
	$id_person = $_COOKIE['id_person'];
	$mysql = new mysqli('localhost', 'root', '', 'shop');
	$mysql->query("SET NAMES 'utf8'");
	$result = $mysql->query ("SELECT * FROM `basket` WHERE `id_person` = '$id_person' AND `id_book` = '$id_book'");
	$book_in_basket = $result->fetch_assoc();
	if(count($book_in_basket) == 0) {		
		$mysql->query("INSERT INTO `basket` (`id_person`, `id_book`, `number`) VALUES('$id_person', '$id_book', '1')");
	}
	else{
		$mysql->query("UPDATE `basket` SET `number` = (`number` + '1') WHERE `id_person` = '$id_person' AND `id_book` = '$id_book'");
	}
	$mysql->close();
	header('Location: /buy/basket.php');