<?php
require "includes/config.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>Регистрация!</title>
	<link rel="stylesheet" type="text/css" href="styles/auth_page_style.css?<?php echo time();?>">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
</head>
<body>
	<!-- Шапка -->
	<header>
		<div class="header_row">
			<div class="header_row_logo">
				<img src="imgs/free-file.png" onclick="redirect_main_page()">
			</div>
			<div class="header_row_search">
				<div class="header_row_search_form">
					<form>
						<input type="text" name="movie_name" placeholder="Введите название фильма" oninput="film_name_ajax(this)">
					</form>
				</div>
				<p onclick="search_form_activate()" class="but" id="0">Поиск</p>
			</div>
			<div class="header_row_signin_up">
				<p>
					<?php
						if(empty($_SESSION['user'])){
							?>
							<a href="authorization_page.php">Войти</a>
							<?php
						}else {
							?>
							<a href="profile.php">Профиль</a>
							<?php
						}
					?>
				</p>
				<p>/</p>
				<p>
					<?php
						if (empty($_SESSION['user'])) {
							?>
							<a href="reg_page.php">Регистрация</a>
							<?php
						}else {
							?>
							<a href="scripts/logout.php">Выйти</a>
							<?php
						}
					?>
				</p>
			</div>
			<div class="header_row_mobile_menu">
				<div class="header_row_mobile_menu_but" onclick="activate_mobile_menu()">
					<div class="header_row_mobile_menu_but_square">
						<div class="header_row_mobile_menu_but_square_line1">
							
						</div>
						<div class="header_row_mobile_menu_but_square_line2">
							
						</div>
						<div class="header_row_mobile_menu_but_square_line3">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="upper_space">
		<div class="upper_space_adapt">
			<div class="upper_space_adapt_logo">
				
			</div>
			<div class="upper_space_adapt_search">
				<div class="upper_space_adapt_search_div">
					<div class="upper_space_adapt_search_div_film">
						<div class="upper_space_adapt_search_div_film_pline1">
							<p>Криминальное чтиво</p>
						</div>
						<div class="upper_space_adapt_search_div_film_pline2">
							<p>Драма 1994г.</p>
						</div>
					</div><hr>
					<div class="upper_space_adapt_search_div_film">
						<div class="upper_space_adapt_search_div_film_pline1">
							<p>Криминальное чтиво</p>
						</div>
						<div class="upper_space_adapt_search_div_film_pline2">
							<p>Драма 1994г.</p>
						</div>
					</div><hr>
					<div class="upper_space_adapt_search_div_film">
						<div class="upper_space_adapt_search_div_film_pline1">
							<p>Криминальное чтиво</p>
						</div>
						<div class="upper_space_adapt_search_div_film_pline2">
							<p>Драма 1994г.</p>
						</div>
					</div><hr>
				</div>
			</div>
			<div class="activated_mobile_menu" id="0">
			<div class="activated_mobile_menu_but1">
				<p><a href="index.php">Главная</a></p>
			</div><hr class="hr1">
			<div class="activated_mobile_menu_but2">
				<p>
					<?php
						if(empty($_SESSION['user'])) {
							?>
							<a href="authorization_page.php">Войти</a>
							<?php
						}else {
							?>
							<a href="profile.php">Профиль</a>
							<?php
						}
					?>
				</p>
			</div><hr class="hr2">
			<div class="activated_mobile_menu_but3">
				<p>
					<?php
					if(empty($_SESSION['user'])) {
							?>
							<a href="reg_page.php">Регистрация</a>
							<?php
						}else {
							?>
							<a href="scripts/logout.php">Выйти</a>
							<?php
						}
					?>
				</p>
			</div>
		</div>
		</div>
	</div>
	<div class="main_content">
		<div class="main_content_auth">
			<p>Регистрация</p>
			<form id="form">
				<input type="text" name="login" placeholder="Логин">
				<input type="text" name="name" placeholder="Имя">
				<input type="text" name="surname" placeholder="Фамилия">
				<input type="password" name="pass" placeholder="Пароль" oninput="check_pass_length(this)">
				<input type="password" name="conf_pass" placeholder="Подтвердите пароль" oninput="check_confpass_length(this)">
				<input type="email" name="email" placeholder="Email">
				<input type="file" name="avatar" oninput="check_file(this)" accept="image/*">
			</form>
			<div class="wrong_auth">
				<p class="wrong_auth_p">Неправильный пароль</p>
			</div>
			<div class="but_auth" onclick="reg_ajax_req()">
				<p>Регистрация</p>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="js/reg_page.js?<?php echo time(); ?>"></script>
</body>
</html>
