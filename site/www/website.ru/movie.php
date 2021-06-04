<?php
require "includes/config.php";
$id = $_GET['id'];
if (!empty($_SESSION['user']['id'])) {
	$user_id = $_SESSION['user']['id'];
	$likes_check = R::findOne('likes','users_idusers = ? AND movies_idmovies = ?',array($user_id,$id));
}
$movies_request = R::getRow('SELECT * FROM movies WHERE `idmovies` = ?',array($id));
$country_name = R::getAll('SELECT * FROM prod_country WHERE `movies_idmovies` = ?',array($id));
$genre_name = R::getAll('SELECT * FROM genre WHERE `movies_idmovies` = ?',array($id));
$views_count = R::getRow('SELECT views_count(?)',array($id));
$movie_score = R::getRow('SELECT movie_score(?)',array($id));
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title><?php echo $movies_request['name']; ?></title>
	<link rel="stylesheet" type="text/css" href="styles/movie_page_style.css?<?php echo time();?>">
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
			<div class="txtblock_rev">
				<p><strong>Описание</strong></p>
				<div class="plus_body" onclick="open_rev(this)" id="0">
					<div class="plus_body_line1">
						
					</div>
					<div class="plus_body_line2">
						
					</div>
				</div>
			</div>
			<div class="content_upperrev">
				<div class="content_upperrev_img">
					<img src="<?php echo $movies_request['img_path']; ?>">
				</div>
				<div class="content_upperrev_text">
					<p>Год производства: <?php echo $movies_request['prod_year']; ?></p>
					<p>Страна: 
						<?php
						foreach ($country_name as $country_name_all) {
							echo $country_name_all['country_name'];
						}
						?>
					</p>
					<p>Жанр: 
						<?php
						foreach ($genre_name as $genre_name_all) {
							echo mb_strtolower($genre_name_all['genre_name'])." ";
						}
						?>
					</p>
					<p>Режиссер: <?php echo $movies_request['producer']; ?></p>
					<p>Сценарий: <?php echo $movies_request['screenwriter']; ?></p>
					<p>Продюссер: <?php echo $movies_request['director']; ?></p>
					<p>Оператор: <?php echo $movies_request['operator']; ?></p>
					<p>Бюджет: $<?php echo $movies_request['budget']; ?></p>
					<p>Просмотров: <?php echo $views_count["views_count($id)"]; ?></p>
					<p>Оценка: <?php echo $movie_score["movie_score($id)"];?>/10</p>
				</div>
			</div>
			<div class="txtblock_trailer">
				<p><strong>Трейлер</strong></p>
				<div class="plus_body" onclick="open_tr(this)" id="0">
					<div class="plus_body_line1">
						
					</div>
					<div class="plus_body_line2">
						
					</div>
				</div>
			</div>
			<div class="content_lowerrev">
				<div class="content_lowerrev_text">
					<p>
						<?php
							echo $movies_request['review'];
						?>
					</p>
				</div>
				<div class="content_lowerrev_trailer">
					<iframe src="<?php echo $movies_request['trailer']; ?>" allowfullscreen></iframe>
				</div>
			</div>
			<div class="txtblock_film">
				<p><strong>Фильм</strong></p>
				<div class="plus_body" onclick="open_film(this)" id="0">
					<div class="plus_body_line1">
						
					</div>
					<div class="plus_body_line2">
						
					</div>
				</div>
			</div>
			<div class="content_film">
				<?php
					if(empty($_SESSION['user'])) {
						?>
							<div class="error_auth">
								<p>Чтобы посмотреть этот фильм авторизируйтесь.</p>
							</div>
						<?php
					}else{
						?>
							<video src="//cloud.cdnland.in/movies/846225b76a839489286a4be2fa755cb7e3f9000f/603e7beeb15af3d66fd4cb3731f05e65:2021042211/240.mp4" controls onclick="plus_view(<?php echo $id; ?>,<?php echo $user_id; ?>)">

							</video>
							<?php
								if (!$likes_check) {
									?>
									<div class="content_film_likebut" onmouseenter="butt_color_plus(this)" onmouseleave="butt_color_minus(this)" onclick="plus_like(<?php echo $id; ?>,<?php echo $user_id; ?>)">
										<p>Мне понравилось</p>
							</div>
									<?php
								}
							?>	
						<?php
					}
				?>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="js/movie_page.js?<?php echo time(); ?>"></script>
</body>
</html>
