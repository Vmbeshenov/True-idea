<?php $title="Интернет-магазин книг «True idea»"; require "../header/header.php"; ?>

<div class="content" id="content_main">
	<script type="text/javacript">
	var q = 0;
	function change_show(){
		q++;
	}
	</script>
	
	<div class="showcase_block">	
		<input type="image" class="showcase_block_img" src="../img/99.jpg" />
		<span class="showcase_text" id ="showcase_text_First_row">True idea</span><br />
		<span class="showcase_text" id ="showcase_text_Second_row">Книжный интернет-магазин!</span>	
	</div>
	<div class="Main_list_block">
		<h2 class ="Main_list_header">Новинки недели</h2>		
		<center><hr class="Main_list_hr" /></center>
		<?php 
		$mysql_book = new mysqli('localhost', 'root', '', 'shop');
		$mysql_book->query("SET NAMES 'utf8'");	
		for($i = 0; $i < 10; $i+=2):
		$id_book  = ($i + 1);
		$result = $mysql_book->query ("SELECT * FROM `books` WHERE `id_book` = '$id_book'");
		$row = $result->fetch_assoc();
		?>		
		<div class="Products_main">
		<form action="../books/book_<?=$id_book?>.php" method="post">
			<center><input type="image" class="imgProduct_main" src="../img/Products/<?=$id_book?>.jpg" /></center>
		</form>		
		<center>
			<p class="nameProduct_main"><?php echo $row["name_book"];?></p>
			<p id="author_book_main"><?php echo $row["author"];?></p>
		</center>		
		<?php 
			if($_COOKIE['user'] != ''):
		?>		
		<span class="ProductCost_main"><?php echo $row["price"];?> ₽</span>		
		<form action="../buy/add_book_to_basket.php" method="post">
			<input type="hidden" name="id_book" value="<?=$id_book?>">
			<input type="submit" class="buttonProduct_main" value="Купить"/>			
		</form>		
		<?php else: ?>
		<form action="../authorization/auth.php" method="post">		
			<span class="ProductCost"><?php echo $row["price"];?> ₽</span>
			<input type="submit" class="buttonProduct_main" value="Купить"/>
		</form>		
		<?php endif; ?>		
		</div>	
		<?php
		endfor;
		?>		
	</div>
	<div class="Main_list_block">
		<h2 class ="Main_list_header">Популярное</h2>		
		<center><hr class="Main_list_hr" /></center>
		<?php 
		for($i = 1; $i < 11; $i+=2):
		$id_book  = ($i + 1);
		$result = $mysql_book->query ("SELECT * FROM `books` WHERE `id_book` = '$id_book'");
		$row = $result->fetch_assoc();
		?>		
		<div class="Products_main">
		<form action="../books/book_<?=$id_book?>.php" method="post">
			<center><input type="image" class="imgProduct_main" src="../img/Products/<?=$id_book?>.jpg" /></center>
		</form>		
		<center>
			<p class="nameProduct_main"><?php echo $row["name_book"];?></p>
			<p id="author_book_main"><?php echo $row["author"];?></p>
		</center>		
		<?php 
			if($_COOKIE['user'] != ''):
		?>		
		<span class="ProductCost_main"><?php echo $row["price"];?> ₽</span>		
		<form action="../buy/add_book_to_basket.php" method="post">
			<input type="hidden" name="id_book" value="<?=$id_book?>">
			<input type="submit" class="buttonProduct_main" value="Купить"/>			
		</form>		
		<?php else: ?>
		<form action="../authorization/auth.php" method="post">		
			<span class="ProductCost"><?php echo $row["price"];?> ₽</span>
			<input type="submit" class="buttonProduct_main" value="Купить"/>
		</form>		
		<?php endif; ?>		
		</div>	
		<?php
		endfor; 	
		$mysql_book->close();
		?>
	</div>	
</div>
<?php require "../footer/footer.php"; ?>