<?php $title="Личный кабинет «True idea»"; require "../header/header.php"; ?>
<h2><span class="head_page_title">Личный кабинет</span></h2>
<br />
<hr class="head_line"/>
<div class="content" id="lk_content">
	<?php
	$mysql = new mysqli('localhost', 'root', '', 'shop');
	$mysql->query("SET NAMES 'utf8'");
	$id_person = $_COOKIE['id_person'];
	$result_person = $mysql->query ("SELECT * FROM `users` WHERE `id` = '$id_person'");
	?>
	<?php while(($row_person = $result_person->fetch_assoc()) != false): ?>	
		<div class="name_lk">Имя</div><div><input type="text" class="form-control_lk" name="name" id="name" placeholder="Имя" value="<?echo $row_person['name'];?>" /></div>
		<div class="name_lk">Логин</div><div><input type="text" class="form-control_lk" name="login" id="login" placeholder="Логин" value="<?echo $row_person['login'];?>" /></div>
		<div class="name_lk">E-mail</div><div><input type="text" class="form-control_lk" name="email" id="email" placeholder="E-mail" value="<?echo $row_person['email'];?>" /></div>
		
	<?php
	endwhile;
	?>
	<form action="../authorization/exit.php">
		<button type="submit" class="lk-btn-exit" >Выход</button>
	</form>
</div>
<?php require "../footer/footer.php"; ?>