<?php
session_start();
include_once ('model/news.php');
include_once ('model/database.php');
include_once ('model/system.php');
$login = mylog();
$db = db_connect();
$news = news_all($db);
$content = template('view/v_index.php',['news' => $news, 'login' => $login]);
$html = template('view/v_main.php',['content' => $content,'title' => 'Новости']);
echo $html;

