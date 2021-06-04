<?php
require "includes/config.php";
$id = $_SESSION['user']['id'];
$user_info = R::getRow('SELECT * FROM users WHERE users.idusers = ?; ',array($id));
$watched_films_count = R::getAll('SELECT count(idviews) FROM views WHERE users_idusers = ?',array($id));
$liked_films = R::getAll('SELECT * from movies join likes on movies.idmovies = likes.movies_idmovies and likes.users_idusers = ?',array($id));
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>Профиль</title>
	<link rel="stylesheet" type="text/css" href="styles/profile_page_style.css?<?php echo time();?>">
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
	<div class="main">
		<div class="content">
			<div class="content_leftside">
				<img src="<?php echo $user_info['avatar']; ?>">
			</div>
			<div class="content_rightside">
				<h1>
					<strong><?php echo $user_info['first_name'] . ' ' . $user_info['surname']; ?></strong>
				</h1>
				<p>
					Логин: <?php echo $user_info['login']; ?>
				</p>
				<p>
					На сайте с <?php echo $user_info['reg_date']; ?>
				</p>
				<p>
					Фильмов просмотрено <?php echo $watched_films_count['0']['count(idviews)']; ?>
				</p>
				<p>
					<a href="#" onclick="change_pass(this)" id="0" class="change_pass_but">Изменить пароль</a>
				</p>
				<div class="content_rightside_change_pass">
					<form class="content_rightside_change_pass_form">
						<input type="text" name="old_pass" placeholder="Введите старый пароль">
						<input type="text" name="new_pass" placeholder="Введите новый пароль">
						<div onclick="change_pass_req()">
							<p>Изменить</p>
						</div>
					</form>
				</div>
				<p>
					<a href="#" onclick="change_email(this)" id="0" class="change_email_but">Изменить почту</a>
				</p>
				<div class="content_rightside_change_email">
					<form class="content_rightside_change_email_form">
						<input type="text" name="old_pass" placeholder="Введите пароль" id='pass'>
						<input type="text" name="new_pass" placeholder="Введите новую почту" id='new_email'>
						<div onclick="change_email_req()">
							<p>Изменить</p>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="liked_films">
			<div class="liked_films_body">
				<div class="liked_films_body_txtblock">
					<p>
						Понравившиеся фильмы 
					</p>
					<div class="plus_body" onclick="open_rev(this)" id="0">
						<div class="plus_body_line1">
							
						</div>
						<div class="plus_body_line2">
							
						</div>
					</div>
				</div>
				<!--  -->
				<div class="liked_films_body_list">
					<div class="search_by_filters_div_body_lover_menu">
						<?php
							foreach ($liked_films as $all_liked_films) {
								$movie_id = $all_liked_films['idmovies'];
								$movie_score_function = R::getRow('SELECT movie_score(?)',array($movie_id));
								$movies_req_country = R::getAll('SELECT * FROM prod_country WHERE movies_idmovies = ?',array($movie_id));
								foreach ($movies_req_country as $movies_req_country_output) {
									$country_name_string = $country_name_string . ' ' . $movies_req_country_output['country_name'];
								}
								echo "<a href='movie.php?id=". $movie_id = $all_liked_films['idmovies'] ."'><div class='search_by_filters_div_body_lover_menu_film'>
											<div class='search_by_filters_div_body_lover_menu_film_av'>
												<img src='". $all_liked_films['img_path'] ."'>
											</div>
											<div class='search_by_filters_div_body_lover_menu_film_review'>
											<p>
												". $all_liked_films['name'] ."
											</p>
											<p>
												Год: ". $all_liked_films['prod_year'] ."
											</p>
											<p>
												Страна: ". $country_name_string ."
											</p>
											<p>
												Режиссер: ". $all_liked_films['producer'] ."
											</p>
											<p>
												Сценарий: ". $all_liked_films['screenwriter'] ."
											</p>
											<p>
												Бюджет: ". $all_liked_films['budget'] ."$
											</p>
											<p>
												Оценка: ". $movie_score_function["movie_score('$movie_id')"] ."/10
											</p>
											</div>
										</div></a>";
								$country_name_string = "";
							}
						?>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="js/profile_page.js?<?php echo time(); ?>"></script>
</body>
</html>
