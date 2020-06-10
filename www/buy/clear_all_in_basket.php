<?php
	$id_person = $_COOKIE['id_person'];
	$mysql = new mysqli('localhost', 'root', '', 'shop');
	$mysql->query("SET NAMES 'utf8'");
	$mysql->query("DELETE FROM `basket` WHERE `id_person` = '$id_person'");
	$mysql->close();
	header('Location: /buy/basket.php');
?>