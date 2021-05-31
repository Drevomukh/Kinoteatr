<?php
require "../includes/config.php";
$login = $_POST['login'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$pass = $_POST['pass'];
$conf_pass = $_POST['conf_pass'];
$email = $_POST['email'];
$file = $_FILES['avatar'];
$date = date("y.m.d");
if (!R::find('users', 'email = ?', array($email))) {
	if (!R::find('users', 'login = ?', array($login))) {
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			if ($pass == $conf_pass) {
				if (mail($email,'Регистрация в онлайн кинотеатре ГАЛАКТИКА','Попытка регистрации')) {
					if ($file['name'] == '') {
						//without av
						R::exec( 'INSERT INTO users(login,first_name,surname,password,email,reg_date) VALUES(?,?,?,?,?,?)',array($login,$name,$surname,$pass,$email,$date) );
						echo "OK";
					}else {
						$path = "/imgs/avatars/" . time() . $file['name'];
						move_uploaded_file($file['tmp_name'], ".." . $path);
						R::exec( 'INSERT INTO users(login,first_name,surname,password,email,reg_date,avatar) VALUES(?,?,?,?,?,?,?)',array($login,$name,$surname,$pass,$email,$date,$path) );
						echo "OK";
					}
				}else {
					echo "Некорректный email";
				}
			}else {
				echo "Пароли не совпадают";
			}
		}else {
			echo "Некорректный email";
		}
	}else {
		echo "Логин уже используется";
	}
}else {
	echo "Email уже используется";
}
?>