<?php
include_once ('model/news.php');
mylog();
$login = myLog();
if(!$login){
    header('Location:login.php');
    die;
}
$db = db_connect();
$list = news_all($db);
include_once ('view/v_edit1.php');




