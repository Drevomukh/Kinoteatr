<?php
session_start();
require("rb-mysql.php");
$connecting = R::setup( 'mysql:host=mariadb;dbname=kinosearch',
        'root', 'root' );
?>