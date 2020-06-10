<?php $title="Регистрация в интернет-магазине «True idea»"; require "../header/header.php"; ?>
<h2><span class="head_page_title">Регистрация</span></h2>
<br />
<hr class="head_line"/>	
<div class="content" id="auth_page">
	<form action="check_reg.php" method="post">
		<input type="text" class="form-control" name="name" id="name" placeholder="Имя" /><br>
		<input type="text" class="form-control" name="login" id="login" placeholder="Логин" /><br>
		<input type="text" class="form-control" name="email" id="email" placeholder="E-mail" /><br>
		<input type="password" class="form-control" name="password" id="password" placeholder="Пароль" /><br>
		<input type="password" class="form-control" name="password_2" id="password_2" placeholder="Повторите пароль" /><br>
		<button type="submit" class="btn-success" id="btn-regist">Зарегистрироваться</button><br>
	</form>
</div>
<?php require "../footer/footer.php"; ?>