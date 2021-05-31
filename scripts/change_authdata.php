<?php
require "../includes/config.php";
$choice = $_POST['choice'];
$user_id = $_SESSION['user']['id'];

if ($choice == 'pass') {
	$old_pass = $_POST['old_pass'];
	$new_pass = $_POST['new_pass'];
	if ($old_pass !== $new_pass) {
		$user = R::findOne('users','idusers = ? AND password = ?',array($user_id,$old_pass));
		if ($user) {
			if ($user['password'] !== $new_pass) {
				R::exec('UPDATE users SET password = ? WHERE idusers = ?',array($new_pass,$user_id));
			echo "Пароль изменён успешно";
			}else {
				echo "Этот пароль уже используется";
			}
		}else {
			echo "Неправильный пароль";
		}
	}else {
		echo "Пароли совпадают";
	}
}else if ($choice == 'email') {
	$old_pass = $_POST['old_pass'];
	$new_email = $_POST['new_email'];
	$user = R::findOne('users','idusers = ?',array($user_id));
	if ($user) {
		if ($user['email'] !== $new_email) {
			R::exec('UPDATE users SET email = ? WHERE idusers = ?',array($new_email,$user_id));
			echo "Email изменён успешно";
		}else {
			echo "Этот email уже используется";
		}
	}
	
}
?>