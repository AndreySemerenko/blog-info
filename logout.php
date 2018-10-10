<?php
session_start();
include_once ('model/news.php');
$_SESSION['log'] = false;
setcookie('name',hash('sha256','admin'),time(),'/');
setcookie('password',hash('sha256','qwerty'),time(),'/');
header('Location:index.php');
exit();
