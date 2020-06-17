<?php
	$id_book_clear_mark = $_POST['id_book_clear_mark'];
	$id_person = $_COOKIE['id_person'];
	$mysql = new mysqli('localhost', 'root', '', 'shop');
	$mysql->query("SET NAMES 'utf8'");
	$result_clear_mark = $mysql->query ("SELECT * FROM `bookmarks` WHERE `id_person` = '$id_person' AND `id_book` = '$id_book_clear_mark'");
	$bookmark_clear = $result_clear_mark->fetch_assoc();
	$mysql->query("DELETE FROM `bookmarks` WHERE `id_person` = '$id_person' AND `id_book` = '$id_book_clear_mark'");
	$mysql->close();
	header('Location: ' . $_SERVER['HTTP_REFERER']);