<?php $title="Финансист. Титан. Стоик - Драйзер Т."; require "../header/header.php"; ?>
<?php 
	$id_book = "2";
	$mysql_book = new mysqli('localhost', 'root', '', 'shop');
	$mysql_book->query("SET NAMES 'utf8'");
	$result = $mysql_book->query ("SELECT * FROM `books` WHERE `id_book` = '$id_book'");
	$row = $result->fetch_assoc();
	if($_COOKIE['user'] != ''):
	$id_person = $_COOKIE['id_person'];
	$result_mark = $mysql_book->query ("SELECT * FROM `bookmarks` WHERE `id_person` = '$id_person' AND `id_book` = '$id_book'");
	$row_mark = $result_mark->fetch_assoc();
	endif;
?>
<div class="Books">
		<div class="book_page_name">
			<span class="nameBook"><?php echo $row["name_book"];?></span>
			<span class="Book_cost"><?php echo $row["price"];?> ₽</span>
			<hr width = 800px />
		</div><br /><br />
		
		<input type="image" class="imgBook" src="../img/Products/<?=$id_book?>.jpg" />
		<?php 
			if($_COOKIE['user'] != '' && $row_mark == ''):
		?>
		<form action="../bookmarks/add_book_to_bookmarks.php" method="post">
			<input type="hidden" name="id_book" value="<?=$id_book?>">
			<input type="submit" class="button_mark_book" value="" title="Добавить в закладки"/>			
		</form>
		
		<?php elseif ($_COOKIE['user'] != ''): ?>
		<form action="../bookmarks/del_book_in_bookmarks.php" method="post">
			<input type="hidden" name="id_book_clear_mark" value="<?=$id_book?>">
			<input type="submit" class="button_mark_book" id="button_mark_book_red" value="" title="Удалить из закладок"/>
		</form>
		
		<?php else: ?>
		<form action="../authorization/auth.php" method="post">
			<input type="hidden" name="id_book" value="<?=$id_book?>">
			<input type="submit" class="button_mark_book" value="" title="Добавить в закладки"/>			
		</form>
		
		<?php endif; ?>
		
		<div class="book_description">		
			<div class="row_description"><span class="name_description">Автор</span> <span class="value_description"><?php echo $row["author"];?></span></div><br />
			<div class="row_description"><span class="name_description">Издательство</span> <span class="value_description"><?php echo $row["Publishing"];?></span></div><br />
			<div class="row_description"><span class="name_description">Год издания</span> <span class="value_description"><?php echo $row["Year_publish"];?></span></div><br />
			<div class="row_description"><span class="name_description">Количество страниц</span> <span class="value_description"><?php echo $row["Number_of_Pages"];?></span></div><br />
			<div class="row_description"><span class="name_description">Тип обложки</span> <span class="value_description"><?php echo $row["Cover"];?></span></div><br />
		</div>
		<?php 
			if($_COOKIE['user'] != ''):
		?>		
		<form action="../buy/add_book_to_basket.php" method="post">
			<input type="hidden" name="id_book" value="<?=$id_book?>">
			<input type="submit" class="button_buy_book" value="Купить"/>			
		</form>		
		<?php else: ?>
		<form action="../authorization/auth.php" method="post">	
			<input type="submit" class="button_buy_book" value="Купить"/>
		</form>
		<?php endif; ?>	
		<div class="text_description">
		<p id="annotasia">Аннотация</p><br />
		<span class="annotasia_text"><?php echo $row["description"];?></span>
		</div>
</div>
<?php $mysql_book->close();	?>
<?php require "../footer/footer.php"; ?>