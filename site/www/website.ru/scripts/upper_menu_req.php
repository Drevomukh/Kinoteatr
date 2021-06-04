<?php
require "../includes/config.php";

$movie_name = $_POST['movie_name'];
$movies = R::getAll('SELECT * FROM movies WHERE name LIKE ?',[ "$movie_name%" ]);
if ($movies) {
	foreach ($movies as $movies_all) {
	$movies_id = $movies_all['idmovies'];
	$country_name = R::getAll('SELECT * FROM prod_country WHERE movies_idmovies = ? LIMIT 0,2',array($movies_id));
	$country_name_out = "";
	foreach ($country_name as $country_name_all) {
		$country_name_out = $country_name_out . $country_name_all['country_name'] . " ";
	}
	echo "<a href='movie.php?id=". $movies_id ."'><div class='upper_space_adapt_search_div_film'>
						<div class='upper_space_adapt_search_div_film_pline1'>
							<p>".$movies_all['name']."</p>
						</div>
						<div class='upper_space_adapt_search_div_film_pline2'>
							<p>". $country_name_out ." ". $movies_all['prod_year'] ."г.</p>
						</div>
					</div></a>";
}
}else {
	echo "Ничего не найдено";
}
?>
