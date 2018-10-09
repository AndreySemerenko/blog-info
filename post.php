<?php
include_once ('model/news.php');
session_start();
if(!myLog()){
    header('Location:login.php');
    die;
}
$db = db_connect();
$fname = $_GET['fname'] ?? null;
if(!isset($fname)){
    echo 'не передано название.ошибка';
}
elseif (!check_title($fname)){
       echo  "Только латинские буквы и цифры!";
}


else{
    $contents = get_descr($db,$fname);
    echo $contents;
}
