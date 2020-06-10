<?php $title="Корзина | «True idea»"; require "../header/header.php"; ?>
<form action="clear_all_in_basket.php" method="post">
	<input type="submit" class="btn_all_del" id="btn_all_del_basket" value="Очистить корзину"/>
</form>
<h2><span class="head_page_title">Корзина</span></h2>
<br />
<hr class="head_line"/>
<div class="content" id="content_basket">
<?php
	if($_COOKIE['user'] != ''):
	$mysql = new mysqli('localhost', 'root', '', 'shop');
	$mysql->query("SET NAMES 'utf8'");
	$id_person = $_COOKIE['id_person'];
	$result_basket = $mysql->query ("SELECT * FROM `basket` WHERE `id_person` = '$id_person'");
	$total = 0;
?>
<?php while(($row_basket = $result_basket->fetch_assoc()) != false): ?>	
		
		<?php	
		$book = $mysql->query ("SELECT * FROM `books` WHERE `id_book` = '$row_basket[id_book]'");
		$id_book = $row_basket['id_book'];
		$row_book = $book->fetch_assoc();
		$bookmarks_in_basket = $mysql->query ("SELECT * FROM `bookmarks` WHERE `id_book` = '$row_basket[id_book]' AND `id_person` = '$id_person' ");
		$row_bookmarks_in_basket = $bookmarks_in_basket->fetch_assoc();
		?>
		
		<div class="Products_buy">
			<form action="../books/book_<?=$id_book?>.php" method="post">
				<input type="image" class="imgProduct_buy" src="../img/Products/<?=$id_book?>.jpg" />
			</form>
			<div id="name_book_buy">
				<span class="nameProduct_buy"><?php echo $row_book["name_book"];?></span><br />
				<span id="author_book_buy"><?php echo $row_book["author"];?></span>
			</div>
		
			<form action="clear_book_in_basket.php" method="post">		
				<input type="hidden" name="id_book_to_clear" value="<?=$row_basket['id_book']?>">
				<input type="submit" class="book_basket_control" id="qual_book_basket_clear" value="Удалить"/>
			</form>
			<?php if($row_bookmarks_in_basket == ''): ?>
			<form action="../bookmarks/add_book_to_bookmarks.php" method="post">		
				<input type="hidden" name="id_book" value="<?=$row_basket['id_book']?>">
				<input type="submit" class="book_basket_control" id="book_basket_add_to_marks" value="Добавить в закладки"/>
			</form>
			<?php else: ?>
			<form action="../bookmarks/del_book_in_bookmarks.php" method="post">		
				<input type="hidden" name="id_book_clear_mark" value="<?=$row_basket['id_book']?>">
				<input type="submit" class="book_basket_control" id="book_basket_del_to_marks" value="Добавлено в закладки"/>
			</form>
			<? endif; ?>
			<div class="book_sum_cost">
				<?php	
				$sum = $row_book["price"] * $row_basket["number"];
				$total += $sum;
				?>		
				<span id="total_one_book"><?php	echo $sum; ?> ₽</span><br />
				<span class="ProductCost_buy"><?php echo $row_book["price"];?> ₽ (1 шт.)</span>			
			</div>
		
			<form action="add_book_to_basket.php" method="post">
				<input type="hidden" name="id_book" value="<?=$row_basket['id_book']?>">
				<input type="submit" class="qual_book_basket" id="qual_book_basket_add" value="+"/>
			</form>		
			<div class="qual_number_block"><span id="qual_number"><?php echo $row_basket["number"]; ?></span></div>
			<form action="del_book_in_basket.php" method="post">		
				<input type="hidden" name="id_book_to_del" value="<?=$row_basket['id_book']?>">
				<input type="submit" class="qual_book_basket" id="qual_book_basket_del" value="-"/>
			</form>
		</div>			
		<br />
		<?php
	endwhile;
	endif;
?>
	<div class="basket_total_block">
	<span class="basket_total_sum">Ваш заказ на сумму:<span id="basket_total_sum_num"><?=$total?> ₽</span></span>
	<form action="order.php" method="post">
		<input type="submit" class="btn-success" id="basket_total_btn" value="Оформить заказ"/>
	</form>
	</div>
</div>
<?php require "../footer/footer.php"; ?>