<?php $title="Закладки | «True idea»"; require "../header/header.php"; ?>
<form action="clear_bookmarks.php" method="post">
	<input type="submit" class="btn_all_del" value="Удалить всё"/>
</form>
<h2><span class="head_page_title">Закладки</span></h2>
<br />
<hr class="head_line"/>
<div class="content">
<?php
	if($_COOKIE['user'] != ''):
	$mysql = new mysqli('localhost', 'root', '', 'shop');
	$mysql->query("SET NAMES 'utf8'");
	$id_person = $_COOKIE['id_person'];
	$result_marks = $mysql->query ("SELECT * FROM `bookmarks` WHERE `id_person` = '$id_person'");
?>
<?php while(($row_marks = $result_marks->fetch_assoc()) != false): ?>	
		<?php	
		$bookmarks = $mysql->query ("SELECT * FROM `books` WHERE `id_book` = '$row_marks[id_book]'");
		$id_book = $row_marks['id_book'];
		$row_bookmarks = $bookmarks->fetch_assoc();
		?>
		<div class="Products">
		<form action="../books/book_<?=$id_book?>.php" method="post">
			<center><input type="image" class="imgProduct" src="../img/Products/<?=$id_book?>.jpg" /></center>
		</form>
		
		<center>
			<p class="nameProduct"><?php echo $row_bookmarks["name_book"];?></p>
			<p id="author_book"><?php echo $row_bookmarks["author"];?></p>
		</center>	
		<span class="ProductCost"><?php echo $row_bookmarks["price"];?> ₽</span>
		
		<form action="../buy/add_book_to_basket.php" method="post">
			<input type="hidden" name="id_book" value="<?=$id_book?>">
			<input type="submit" id="btn_from_marks_to_basket" class="buttonProduct" value="В корзину"/>	
		</form>
		<form action="del_book_in_bookmarks.php" method="post">		
		<input type="hidden" name="id_book_clear_mark" value="<?=$row_marks['id_book']?>">
		<input type="submit" class="qual_bookmarks" value="Удалить"/>
		</form>		
		
		</div>
		<?php
endwhile;
	endif;
?>
</div>
<?php require "../footer/footer.php"; ?>