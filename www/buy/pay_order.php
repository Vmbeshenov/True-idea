<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta name="keywords" content="shop, book" />
		<link href="../css/style.css" rel="stylesheet" type="text/css" />
		<link href="../img/favicon.png" rel="shortcut icon" type="image/x-icon" />		
		<title>Оплата заказа | «True idea»</title>
	</head>
	<body>
		<div id="page-wrap">		
			<div class="content" id="pay_order_content">
				<form action="check_pay.php" method="post">
					<div class="card-format">
					<span></span><input type="text" class="card-control" name="card_number" id="card_number" placeholder="0000 0000 0000 0000" /><br>
					<span></span><input type="text" class="card-control" name="month_year" id="month_year" placeholder="03/20" /><br>
					<span></span><input type="password" class="card-control" name="CVC2" id="CVC2" placeholder="CVC2"  /><br>
					<span></span><input type="text" class="card-control" name="name_card" id="name_card" placeholder="IVAN IVANOV" /><br>
					<input type="image" class="imgCard" src="../img/visa.jpg" />
					<input type="image" class="imgCard" src="../img/mastercard.jpg" />
					</div>
					<button type="submit" class="btn-success" id="btn-pay">Оплатить</button><br>
				</form>
			</div>		
		</div>
	</body>
</html>