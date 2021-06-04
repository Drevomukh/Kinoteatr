<?php
require "includes/config.php";
$test = R::getAll('SELECT * FROM movies');
var_dump($test);
foreach ($test as $tests) {
	echo $tests["name"];
}
// var_dump($test);
// echo $test[1]["name"];
?>