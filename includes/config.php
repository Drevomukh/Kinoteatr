<?php
session_start();
require("rb-mysql.php");
$connecting = R::setup( 'mysql:host=127.0.0.1:3307;dbname=kinosearch',
        'root', '' );
?>