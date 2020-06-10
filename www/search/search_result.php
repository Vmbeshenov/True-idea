<?php $title="Результаты поиска"; require "../header/header.php"; ?>
<h2><span class="head_page_title">Результаты поиска</span></h2>
<br />
<hr class="head_line"/>	
<div class="content">
<?php
	$search = filter_var(trim($_POST['search']), FILTER_SANITIZE_STRING);
	if ($search == ''): echo "Ничего не найдено!";
	else:
	$mysql = new mysqli('localhost', 'root', '', 'shop');
	$mysql->query("SET NAMES 'utf8'");
	$test_search = $mysql->query("SELECT * FROM `books` WHERE `name_book` LIKE '%$search%' OR `author` LIKE '%$search%' ");
	$test_result = $test_search->fetch_assoc();
	if ($test_result == ''): echo "Ничего не найдено!";
	else:
	$search_result = $mysql->query("SELECT * FROM `books` WHERE `name_book` LIKE '%$search%' OR `author` LIKE '%$search%' ");
	while(($search_book = $search_result->fetch_assoc()) != false):		
?>	
	<div class="Products">
		<form action="../books/book_<?=$search_book['id_book']?>.php" method="post">
			<center><input type="image" class="imgProduct" src="../img/Products/<?=$search_book['id_book']?>.jpg" /></center>
		</form>
		
		<center>
			<p class="nameProduct"><?php echo $search_book['name_book']?></p>
			<p id="author_book"><?php echo $search_book["author"];?></p>
		</center>
		
		<?php 
			if($_COOKIE['user'] != ''):
		?>
		
		<span class="ProductCost"><?php echo $search_book["price"];?> ₽</span>
		
		<form action="../buy/add_book_to_basket.php" method="post">
			<input type="hidden" name="id_book" value="<?=$search_book['id_book']?>">
			<input type="submit" class="buttonProduct" value="Купить"/>			
		</form>
		<?php else: ?>
		<form action="../authorization/auth.php" method="post">		
			<span class="ProductCost"><?php echo $search_book["price"];?> ₽</span>
			<input type="submit" class="buttonProduct" value="Купить"/>
		</form>
		
		<?php endif; ?>
		
	</div>
	<?php
	endwhile;
	endif;
	endif;
	?>
</div>
<?php require "../footer/footer.php"; ?>