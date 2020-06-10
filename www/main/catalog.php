<?php $title="Интернет-магазин «True idea»"; require "../header/header.php"; ?>
<h2><span class="head_page_title">Каталог</span></h2>
<br />
<hr class="head_line"/>	
<div class="content">
	<?php 
	$mysql_book = new mysqli('localhost', 'root', '', 'shop');
	$mysql_book->query("SET NAMES 'utf8'");	
	for($i = 0; $i < 19; $i++):
	$id_book  = ($i + 1);
	$result = $mysql_book->query ("SELECT * FROM `books` WHERE `id_book` = '$id_book'");
	$row = $result->fetch_assoc();
	?>
	
	<div class="Products">
		<form action="../books/book_<?=$id_book?>.php" method="post">
			<center><input type="image" class="imgProduct" src="../img/Products/<?=$id_book?>.jpg" /></center>
		</form>
		
		<center>
			<p class="nameProduct"><?php echo $row["name_book"];?></p>
			<p id="author_book"><?php echo $row["author"];?></p>
		</center>
		
		<?php 
			if($_COOKIE['user'] != ''):
		?>
		
		<span class="ProductCost"><?php echo $row["price"];?> ₽</span>
		
		<form action="../buy/add_book_to_basket.php" method="post">
			<input type="hidden" name="id_book" value="<?=$id_book?>">
			<input type="submit" class="buttonProduct" value="Купить"/>			
		</form>
		
		<?php else: ?>
		<form action="../authorization/auth.php" method="post">		
			<span class="ProductCost"><?php echo $row["price"];?> ₽</span>
			<input type="submit" class="buttonProduct" value="Купить"/>
		</form>
		
		<?php endif; ?>
		
	</div>
	
	<?php
	endfor; 	
	$mysql_book->close();
	?>
</div>
<?php require "../footer/footer.php"; ?>