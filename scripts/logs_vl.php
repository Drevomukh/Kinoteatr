<?php
require "../includes/config.php";
$choice = $_POST['choice'];
$user_id = $_POST['user_id'];
$movie_id = $_POST['movie_id'];
$check = R::findOne('views','users_idusers = ? AND movies_idmovies = ?',array($user_id,$movie_id));
if (($choice == 'view') AND (!$check)) {
	R::exec('INSERT INTO views(movies_idmovies,users_idusers) VALUES(?,?)',array($movie_id,$user_id));
	echo 'OK';
}else if ($choice == 'like') {
	R::exec('INSERT INTO likes(movies_idmovies,users_idusers) VALUES(?,?)',array($movie_id,$user_id));
	echo "Like+";
}
?>