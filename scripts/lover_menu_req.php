<?php
require "../includes/config.php";
$country_name = $_POST['country_name'];
$genre_name = $_POST['genre_name'];
if ($country_name == 'none' and $genre_name <> 'none')  {
	$movies_req = R::getAll('SELECT * FROM movies JOIN genre ON genre.movies_idmovies=movies.idmovies AND genre.genre_name = ?',array($genre_name));
	foreach ($movies_req as $movies_req_output) {
		$movie_id = $movies_req_output['idmovies'];
		$movie_score_function = R::getRow('SELECT movie_score(?)',array($movie_id));
		$movies_req_country = R::getAll('SELECT * FROM prod_country WHERE movies_idmovies = ?',array($movie_id));
		foreach ($movies_req_country as $movies_req_country_output) {
			$country_name_string = $country_name_string . ' ' . $movies_req_country_output['country_name'];
		}
		echo "<a href='movie.php?id=". $movie_id = $movies_req_output['idmovies'] ."'><div class='search_by_filters_div_body_lover_menu_film'>
					<div class='search_by_filters_div_body_lover_menu_film_av'>
						<img src='". $movies_req_output['img_path'] ."'>
					</div>
					<div class='search_by_filters_div_body_lover_menu_film_review'>
					<p>
						". $movies_req_output['name'] ."
					</p>
					<p>
						Год: ". $movies_req_output['prod_year'] ."
					</p>
					<p>
						Страна: ". $country_name_string ."
					</p>
					<p>
						Режиссер: ". $movies_req_output['producer'] ."
					</p>
					<p>
						Сценарий: ". $movies_req_output['screenwriter'] ."
					</p>
					<p>
						Бюджет: ". $movies_req_output['budget'] ."$
					</p>
					<p>
						Оценка: ". $movie_score_function["movie_score('$movie_id')"] ."/10
					</p>
					</div>
				</div></a>";
		$country_name_string = "";
	}
}else if ($country_name <> 'none' and $genre_name == 'none') {
	$movies_req = R::getAll('SELECT * FROM movies JOIN prod_country ON prod_country.movies_idmovies=movies.idmovies AND prod_country.country_name = ?',array($country_name));
	foreach ($movies_req as $movies_req_output) {
		$movie_id = $movies_req_output['idmovies'];
		$movie_score_function = R::getRow('SELECT movie_score(?)',array($movie_id));
		$movies_req_country = R::getAll('SELECT * FROM prod_country WHERE movies_idmovies = ?',array($movie_id));
		foreach ($movies_req_country as $movies_req_country_output) {
			$country_name_string = $country_name_string . ' ' . $movies_req_country_output['country_name'];
		}
		echo "<a href='movie.php?id=". $movie_id = $movies_req_output['idmovies'] ."'><div class='search_by_filters_div_body_lover_menu_film'>
					<div class='search_by_filters_div_body_lover_menu_film_av'>
						<img src='". $movies_req_output['img_path'] ."'>
					</div>
					<div class='search_by_filters_div_body_lover_menu_film_review'>
					<p>
						". $movies_req_output['name'] ."
					</p>
					<p>
						Год: ". $movies_req_output['prod_year'] ."
					</p>
					<p>
						Страна: ". $country_name_string ."
					</p>
					<p>
						Режиссер: ". $movies_req_output['producer'] ."
					</p>
					<p>
						Сценарий: ". $movies_req_output['screenwriter'] ."
					</p>
					<p>
						Бюджет: ". $movies_req_output['budget'] ."$
					</p>
					<p>
						Оценка: ". $movie_score_function["movie_score('$movie_id')"] ."/10
					</p>
					</div>
				</div></a>";
		$country_name_string = "";
	}
}else if ($country_name <> 'none' and $genre_name <> 'none') {
	$movies_req = R::getAll('SELECT * FROM movies JOIN prod_country ON prod_country.movies_idmovies=movies.idmovies AND prod_country.country_name = ? JOIN genre ON genre.movies_idmovies = movies.idmovies AND genre.genre_name = ?',array($country_name,$genre_name));
	foreach ($movies_req as $movies_req_output) {
		$movie_id = $movies_req_output['idmovies'];
		$movie_score_function = R::getRow('SELECT movie_score(?)',array($movie_id));
		$movies_req_country = R::getAll('SELECT * FROM prod_country WHERE movies_idmovies = ?',array($movie_id));
		foreach ($movies_req_country as $movies_req_country_output) {
			$country_name_string = $country_name_string . ' ' . $movies_req_country_output['country_name'];
		}
		echo "<a href='movie.php?id=". $movie_id = $movies_req_output['idmovies'] ."'><div class='search_by_filters_div_body_lover_menu_film'>
					<div class='search_by_filters_div_body_lover_menu_film_av'>
						<img src='". $movies_req_output['img_path'] ."'>
					</div>
					<div class='search_by_filters_div_body_lover_menu_film_review'>
					<p>
						". $movies_req_output['name'] ."
					</p>
					<p>
						Год: ". $movies_req_output['prod_year'] ."
					</p>
					<p>
						Страна: ". $country_name_string ."
					</p>
					<p>
						Режиссер: ". $movies_req_output['producer'] ."
					</p>
					<p>
						Сценарий: ". $movies_req_output['screenwriter'] ."
					</p>
					<p>
						Бюджет: ". $movies_req_output['budget'] ."$
					</p>
					<p>
						Оценка: ". $movie_score_function["movie_score('$movie_id')"] ."/10
					</p>
					</div>
				</div></a>";
		$country_name_string = "";
	}
}else if ($country_name == 'none' and $genre_name == 'none') {
	$movies_req = R::getAll('SELECT * FROM movies');
	foreach ($movies_req as $movies_req_output) {
		$movie_id = $movies_req_output['idmovies'];
		$movie_score_function = R::getRow('SELECT movie_score(?)',array($movie_id));
		$movies_req_country = R::getAll('SELECT * FROM prod_country WHERE movies_idmovies = ?',array($movie_id));
		foreach ($movies_req_country as $movies_req_country_output) {
			$country_name_string = $country_name_string . ' ' . $movies_req_country_output['country_name'];
		}
		echo "<a href='movie.php?id=". $movie_id = $movies_req_output['idmovies'] ."'><div class='search_by_filters_div_body_lover_menu_film'>
					<div class='search_by_filters_div_body_lover_menu_film_av'>
						<img src='". $movies_req_output['img_path'] ."'>
					</div>
					<div class='search_by_filters_div_body_lover_menu_film_review'>
					<p>
						". $movies_req_output['name'] ."
					</p>
					<p>
						Год: ". $movies_req_output['prod_year'] ."
					</p>
					<p>
						Страна: ". $country_name_string ."
					</p>
					<p>
						Режиссер: ". $movies_req_output['producer'] ."
					</p>
					<p>
						Сценарий: ". $movies_req_output['screenwriter'] ."
					</p>
					<p>
						Бюджет: ". $movies_req_output['budget'] ."$
					</p>
					<p>
						Оценка: ". $movie_score_function["movie_score('$movie_id')"] ."/10
					</p>
					</div>
				</div></a>";
		$country_name_string = "";
	}
}
?>