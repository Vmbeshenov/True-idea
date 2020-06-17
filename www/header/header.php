<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta name="keywords" content="shop, book" />
		<link href="../css/style.css" rel="stylesheet" type="text/css" />
		<link href="../img/favicon.png" rel="shortcut icon" type="image/x-icon" />		
		<title><?=$title?></title>
		
		<script type="text/javascript">		
			function startTime(){
                const tm = new Date();
                const h = tm.getHours();
                let m = tm.getMinutes();
                let s = tm.getSeconds();
                m=checkTime(m);
				s=checkTime(s);
				document.getElementById('txt').innerHTML=h+":"+m+":"+s;
                const t = setTimeout('startTime()', 500);
            }
			function checkTime(i){
				if (i<10)
					{
						i="0" + i;
					}
				return i;
			}
		</script>

	</head>
	<body onload="startTime()">
		<div id="page-wrap">
		<header>
			<a href="../main/index.php" title="На главную страницу" id="logo">True idea</a>
			<form action="../search/search_result.php" method="post">			
			<input type="search" class="field" name="search" placeholder="Поиск..." />
			<input type="image" src="../img/Search.png" value="Найти" id="searchButton" name="searchButton" />
			</form>
			<?php 
				if($_COOKIE['user'] != ''):
			
				$mysql_main = new mysqli('localhost', 'root', '', 'shop');
				$mysql_main->query("SET NAMES 'utf8'");
				$id_person = $_COOKIE['id_person'];
				$result_basket = $mysql_main->query ("SELECT * FROM `basket` WHERE `id_person` = '$id_person'");
				$row_basket = $result_basket->num_rows;
				$result_bookmarks = $mysql_main->query ("SELECT * FROM `bookmarks` WHERE `id_person` = '$id_person'");
				$row_bookmarks = $result_bookmarks->num_rows;
				?>
				<span class="contactHeader"><a href="../buy/lk.php">Личный кабинет</a></span>
				<span class="contactHeader" id="slash">|</span>
				<span class="contactHeader"><a href="../buy/basket.php">Корзина: <?php echo $row_basket ?></a></span>
			<?php else: ?>
				<span class="contactHeader"><a href="../authorization/auth.php">Вход</a></span>
				<span class="contactHeader">|</span>
				<span class="contactHeader"><a href="../authorization/reg.php">Регистрация</a></span>
			<?php endif; ?>
		</header>
		<div id="Navigator">
			<span class="MenuNavigator" id="FirstMenu"><a href="../main/catalog.php">Каталог</a></span>
			<span class="MenuNavigator"><a href="../bookmarks/bookmarks.php">Закладки: <?php echo $row_bookmarks ?></a></span>
			<?php 
				if($_COOKIE['user'] != ''):
			?>
			<span class="MenuNavigator"><i>Вы вошли как: </i><a href="../buy/lk.php"><?php echo $_COOKIE['user']?></a></span>
			<?php else: ?>
				<span class="MenuNavigator"><i>Добро пожаловать!</i></span>
			<?php endif;
			?>
		</div>		
		<div class="second_back">