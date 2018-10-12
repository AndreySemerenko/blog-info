<?php
session_start();
include_once ('model/news.php');
include_once ('model/database.php');
include_once ('model/system.php');
$login = mylog();
if(!$login){
    header('Location:login.php');
    die;
}
$db = db_connect();
$fname = $_GET['fname'] ?? null;
if(!isset($fname)){
    echo 'не передано название.ошибка';
}
elseif (check_title($fname)){
       echo  "Только русские буквы и цифры";
}


else{
    $contents = get_descr($db,$fname);
    $content = template('view/v_post.php',['contents' => $contents]);
    $html = template('view/v_main.php',['content' => $content,'title' => 'Новость']);
    echo $html;
}
