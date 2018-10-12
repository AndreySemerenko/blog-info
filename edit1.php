<?php
session_start();
include_once ('model/news.php');
include_once ('model/database.php');
include_once ('model/system.php');
mylog();
$login = myLog();
if(!$login){
    header('Location:login.php');
    die;
}
$db = db_connect();
$list = news_all($db);
$content = template('view/v_edit1.php',['list' => $list]);
$html = template('view/v_main.php',['content' => $content,'title' => 'Выберете новость']);
echo $html;




