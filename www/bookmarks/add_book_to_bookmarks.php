<?php
	$id_book = $_POST['id_book'];
	$id_person = $_COOKIE['id_person'];
	$mysql = new mysqli('localhost', 'root', '', 'shop');
	$mysql->query("SET NAMES 'utf8'");
	$result = $mysql->query ("SELECT * FROM `bookmarks` WHERE `id_person` = '$id_person' AND `id_book` = '$id_book'");
	$book_in_marks = $result->fetch_assoc();
	if(count($book_in_marks) == 0) {		
		$mysql->query("INSERT INTO `bookmarks` (`id_person`, `id_book`) VALUES('$id_person', '$id_book')");
	}
	$mysql->close();
	header('Location: ' . $_SERVER['HTTP_REFERER']);
?>