<?php
	setcookie('user', $user['name'], time() - (3600 * 24), "/");
	setcookie('id_person', $user['id'], time() - (3600 * 24), "/");
	header('Location: /main');