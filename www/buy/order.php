<?php $title="Оформление заказа | «True idea»"; require "../header/header.php"; ?>
<h2><span class="head_page_title">Оформление заказа</span></h2>
<br />
<hr class="head_line"/>

<div class="content" id="order_content">

	<?php
	$total = 0;
	$mysql = new mysqli('localhost', 'root', '', 'shop');
	$mysql->query("SET NAMES 'utf8'");
	$id_person = $_COOKIE['id_person'];
	$result_person = $mysql->query ("SELECT * FROM `users` WHERE `id` = '$id_person'");
	
	$result_order = $mysql->query ("SELECT * FROM `basket` WHERE `id_person` = '$id_person'");
	while(($row_order = $result_order->fetch_assoc()) != false): 
		$book = $mysql->query ("SELECT * FROM `books` WHERE `id_book` = '$row_order[id_book]'");
		$id_book = $row_order['id_book'];
		$row_book = $book->fetch_assoc();
		$sum = $row_book["price"] * $row_order["number"];
		$total += $sum;
	endwhile;
	?>
	
	<h2>Укажите контактные данные</h2>
	
	<form action="order_success.php" method="post">
	
	<?php while(($row_person = $result_person->fetch_assoc()) != false): ?>	
		<div class="name_lk">Фамилия</div><div><input type="text" class="form-control_lk" name="surname" id="surname"value="<?echo $row_person['surname'];?>" /></div>
		<div class="name_lk">Имя</div><div><input type="text" class="form-control_lk" name="name" id="name"value="<?echo $row_person['name'];?>" /></div>
		<div class="name_lk">E-mail</div><div><input type="text" class="form-control_lk" name="email" id="email"value="<?echo $row_person['email'];?>" /></div>
		<div class="name_lk">Телефон <span id="number_phone_text_h">+7 (XXX) XXX-XX-XX</span></div><div><input type="text" class="form-control_lk" name="phone" id="phone" value="<?echo $row_person['number_phone'];?>" /></div>
	<?php endwhile;	?>
	
	<h2>Доставка</h2>
		<div class="name_lk">Город</div><div><input type="text" class="form-control_lk" name="city" id="city"/></div>
		<div class="name_lk">Улица</div><div><input type="text" class="form-control_lk" name="street" id="street"/></div>
		<div class="name_lk">Почтовый индекс</div><div><input type="text" class="form-control_lk" name="postcode" id="postcode"/></div>
		<div class="name_lk">Дом</div><div><input type="text" class="form-control_lk" name="house" id="house"/></div>
		<div class="name_lk">Квартира</div><div><input type="text" class="form-control_lk" name="apartment" id="apartment"/></div>
	
	<h2>Оплата</h2>
	
		<p><input name="payment_method" type="radio" value="online">Оплата на сайте онлайн</p>
		<p><input name="payment_method" type="radio" value="offline">Оплата при получении заказа</p>	
	<div class="basket_total_block" id="order_total_block">
		<span class="basket_total_sum">Ваш заказ на сумму:<span id="basket_total_sum_num"><?=$total?> ₽</span></span>
		<input type="submit" class="btn-success" id="basket_total_btn" value="Заказать"/>
	</div>
	
	</form>
	
	
	
	<br /><br /><br /><br /><br />
	<h2>Ваш Заказ:</h2>
	<?php
		$result_order = $mysql->query ("SELECT * FROM `basket` WHERE `id_person` = '$id_person'");
	?>
	<?php while(($row_order = $result_order->fetch_assoc()) != false): ?>
		
		<?php	
		$book = $mysql->query ("SELECT * FROM `books` WHERE `id_book` = '$row_order[id_book]'");
		$id_book = $row_order['id_book'];
		$row_book = $book->fetch_assoc();		
		?>
		
		<div class="Products_buy">
			<form action="../books/book_<?=$id_book?>.php" method="post">
				<input type="image" class="imgProduct_buy" src="../img/Products/<?=$id_book?>.jpg" />
			</form>
			<div id="name_book_buy">
				<span class="nameProduct_buy"><?php echo $row_book["name_book"];?></span><br />
				<span id="author_book_buy"><?php echo $row_book["author"];?></span>
			</div>
		
			<div class="book_sum_cost">
				<?php	
				$sum = $row_book["price"] * $row_order["number"];
				
				?>		
				<span id="total_one_book"><?php	echo $sum; ?> ₽</span><br />
				<span class="ProductCost_buy"><?php echo $row_book["price"];?> ₽ (1 шт.)</span>			
			</div>	
			<div class="qual_number_block"><span id="qual_number"><?php echo $row_order["number"]; ?></span></div>	
		</div>			
		<br />
		<?php
	endwhile;
	$mysql->close();
	?>
	
</div>

<?php require "../footer/footer.php"; ?>