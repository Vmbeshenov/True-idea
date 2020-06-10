<?php $title="Вход в личный кабинет"; require "../header/header.php"; ?>
<h2><span class="head_page_title">Войти</span></h2>
<br />
<hr class="head_line"/>
<div class="content" id="auth_page">
	<form action="check_auth.php" method="post">
		<input type="text" class="form-control" name="login" id="login" placeholder="Логин" />
		<input type="password" class="form-control" name="password" id="password" placeholder="Пароль" />
		<button type="submit" id="btn-auth" class="btn-success">Войти</button>
	</form>
	<form action="reg.php" method="post">
		<button type="submit" id="btn-reg" class="btn-success">Зарегистрироваться</button>
	</form>
</div>
<?php require "../footer/footer.php"; ?>