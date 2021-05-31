<?php
require "includes/config.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>Главная!</title>
	<link rel="stylesheet" type="text/css" href="styles/index_page_style.css?<?php echo time();?>">
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
	<!-- Конец шапки -->
	<div class="novelty">
		<div class="novelty_p ">
			<div class="novelty_p_textbl">
				<p>Новинки</p>
			</div>
		</div>
	</div>
	<!-- Слайдер -->
	<div class="slider">
		<div class="slider_content">
			<div class="slider_content_prev">
				<p onclick="prev_slide(-1)"><strong><<</strong></p>
			</div>
			<div class="slider_content_body">
				<?php
					$movies_request = R::getAll('SELECT * FROM movies ORDER BY `upload_date` DESC LIMIT 0,10');
					foreach ($movies_request as $movies_request_all) {
						$movie_id = $movies_request_all['idmovies'];
						$genres = R::getAll('SELECT * FROM genre WHERE `movies_idmovies` = ?',array($movie_id));
						?>
							<div class="slider_content_body_movie_preview">
								<a href="movie.php?id=<?php echo $movie_id?>">
								<div class="slider_content_body_movie_preview_inside">
									<div class="slider_content_body_movie_preview_leftside">
										<div class="slider_content_body_movie_preview_leftside_img">
											<img src="<?php echo  $movies_request_all['img_path']; ?>">
										</div>
									</div>
									<div class="slider_content_body_movie_preview_rightside">
										<div class="slider_content_body_movie_preview_rightside_review">
											<h1><?php echo $movies_request_all['name']; ?> (<?php echo $movies_request_all['prod_year']; ?>)</h1>
											<p>Жанр: <?php
												foreach ($genres as $genres_all) {
													echo mb_strtolower($genres_all['genre_name'])." ";
												}
											?>
											</p>
											<p>Год выпуска:<?php echo $movies_request_all['prod_year'];?></p>
											<p>Режиссер:<?php echo $movies_request_all['producer'];?></p>
											<p>Бюджет:<?php echo $movies_request_all['budget'];?>$</p>
											<p>Длительность: <?php echo $movies_request_all['duration'];?> мин.</p>
										</div>
									</div>
								</div></a>
							</div>
						<?php
					}
				?>
				<!-- Тело слайдера -->
			</div>
			<div class="slider_content_next">
				<p onclick="next_slide(1)"><strong>>></strong></p>
			</div>
		</div>
	</div>
	<!-- конец Слайдера -->
	<div class="search_by_filters_txt">
		<div class="search_by_filters_txtblck">
			<div class="search_by_filters_txtblck_p">
				<p>Поиск по фильтрам</p>
			</div>
		</div>
	</div>
	<!-- поиск по фильтрам -->
	<div class="search_by_filters_div">
		<div class="search_by_filters_div_body">
			<div class="search_by_filters_div_body_upper_menu">
				<form>
					<div>
						<p>Жанр:</p>
					<select class="search_by_filters_div_body_upper_menu_select" onchange="ajaxSendgenre(this)" id="genre_select">
						<option class="hidden_option" value="none">
							-- Жанр --
						</option>
						<?php
							$all_genres = R::getAll('SELECT DISTINCT genre_name FROM genre');
							foreach ($all_genres as $all_genres_output) {
								?>
									<option>
										<?php echo $all_genres_output['genre_name'] ?>
									</option>
								<?php
							}
						?>
					</select>
					</div>
					<div>
						<p>Страна:</p>
					<select class="search_by_filters_div_body_upper_menu_select" id="country_select" onchange="ajaxSendcountry(this)">
						<option class="hidden_option" value="none">
							-- Страна --
						</option>
						<?php
							$all_countrys = R::getAll('SELECT DISTINCT country_name FROM prod_country');
							foreach ($all_countrys as $all_countrys_output) {
								?>
									<option>
										<?php echo $all_countrys_output['country_name'] ?>
									</option>
								<?php
							}
						?>
					</select>
					</div>
				</form>
			</div>
			<div class="search_by_filters_div_body_lover_menu">
				</div>
			</div>
		</div>
	</div>
	<div class="lover_space">
		
	</div>
	<!-- конец поиска по фильтрам -->
	<!-- Далее подключение к этой странице js файла -->
	<script type="text/javascript" src="js/main_page.js?<?php echo time(); ?>"></script>

</body>
</html>
