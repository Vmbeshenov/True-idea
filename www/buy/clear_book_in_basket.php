<?php
	$id_book_to_clear = $_POST['id_book_to_clear'];
	$id_person = $_COOKIE['id_person'];
	$mysql = new mysqli('localhost', 'root', '', 'shop');
	$mysql->query("SET NAMES 'utf8'");
	$result_clear = $mysql->query ("SELECT * FROM `basket` WHERE `id_person` = '$id_person' AND `id_book` = '$id_book_to_clear'");
	$book_in_basket_clear = $result_clear->fetch_assoc();
	$mysql->query("DELETE FROM `basket` WHERE `id_person` = '$id_person' AND `id_book` = '$id_book_to_clear'");
	$mysql->close();
	header('Location: /buy/basket.php');