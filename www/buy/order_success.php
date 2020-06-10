<?php $title="Зазаз принят!"; require "../header/header.php"; ?>
<?php
	
	$surname = filter_var(trim($_POST['surname']), FILTER_SANITIZE_STRING);
	$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
	$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
	$phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING);	
	
	$city = filter_var(trim($_POST['city']), FILTER_SANITIZE_STRING);
	$street = filter_var(trim($_POST['street']), FILTER_SANITIZE_STRING);
	$postcode = filter_var(trim($_POST['postcode']), FILTER_SANITIZE_STRING);
	$house = filter_var(trim($_POST['house']), FILTER_SANITIZE_STRING);
	$apartment = filter_var(trim($_POST['apartment']), FILTER_SANITIZE_STRING);
	
	$payment_method = filter_var(trim($_POST['payment_method']), FILTER_SANITIZE_STRING);
	$price_order = 0;
	$pay_status = "Не оплачен";
	$order_status = "Формирование";
	$mysql = new mysqli('localhost', 'root', '', 'shop');
	$mysql->query("SET NAMES 'utf8'");
	$id_person = $_COOKIE['id_person'];
	
	$mysql->query("INSERT INTO `orders` (`id_order`, `id_person`, `price_order`,
	`order_status`, `payment_method`, `pay_status`, `city`, `street`, `postcode`, `house`, `apartment`) 
	VALUES(NULL, '$id_person', '$price_order', '$order_status',
	'$payment_method', '$pay_status', '$city', '$street', '$postcode', '$house', '$apartment') ");
	
	$result_order = $mysql->query ("SELECT * FROM `orders` WHERE `id_person` = '$id_person' AND `order_status` = '$order_status' ");
	$row_order = $result_order->fetch_assoc();
	$id_order = $row_order['id_order'];
	
	$result_order = $mysql->query ("SELECT * FROM `basket` WHERE `id_person` = '$id_person'");
	while(($row_order = $result_order->fetch_assoc()) != false): 
		$book = $mysql->query ("SELECT * FROM `books` WHERE `id_book` = '$row_order[id_book]'");
		$id_book = $row_order['id_book'];
		$row_book = $book->fetch_assoc();
		$price_position = $row_book["price"] * $row_order["number"];
		$price_order += $price_position;
		$order_status = "Принят";
		$mysql->query("INSERT INTO `orders_positions` (`id_position`, `id_order`, `id_book`, `number`, `price_position`) 
		VALUES(NULL, '$id_order', '$id_book', '$row_order[number]', '$price_position') ");
	endwhile;
	$order_status = "Принят";
	$mysql->query("UPDATE `orders` SET `price_order` = '$price_order', `order_status` = '$order_status' WHERE `id_order` = '$id_order' ");
	
	$mysql->query("DELETE FROM `basket` WHERE `id_person` = '$id_person'");
	
	$mysql->close();
?>
<h1>Заказ принят!</h1>
<form action="pay_order.php" method="post">
		<input type="submit" class="btn-success" id="order_s_btn" value="Оплатить"/>
</form>
<?php require "../footer/footer.php"; ?>