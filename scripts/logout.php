<?php
require "../includes/config.php";
unset($_SESSION);
session_destroy();
header("Location: ../authorization_page.php");
?>