<?php include_once ('model/news.php');
mylog();
$db = db_connect();
$news = news_all($db);
include_once ('view/v_index.php');
