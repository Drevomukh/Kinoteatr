<?php
require "../includes/config.php";
$login = $_POST['login'];
$pass = $_POST['pass'];

$check_data = R::findOne('users','login = ?',array($login));
if ($check_data) {
	if ($pass == $check_data['password']) {
		$_SESSION['user'] = array(
			'id' => $check_data['idusers'],
			'login' => $check_data['login'],
			'email' => $check_data['email'],
			'img' => $check_data['avatar']
		);
		echo "OK";
	}else {
		echo "Неверный пароль";
	}
}else {
	echo "Логин не найден";
}
?>