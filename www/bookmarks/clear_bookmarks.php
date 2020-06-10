<?php
	$id_person = $_COOKIE['id_person'];
	$mysql = new mysqli('localhost', 'root', '', 'shop');
	$mysql->query("SET NAMES 'utf8'");
	$result_all_clear = $mysql->query ("SELECT * FROM `bookmarks` WHERE `id_person` = '$id_person'");
	$book_in_basket_all_clear = $result_all_clear->fetch_assoc();
	$mysql->query("DELETE FROM `bookmarks` WHERE `id_person` = '$id_person'");
	$mysql->close();
	header('Location: /bookmarks/bookmarks.php');
?>