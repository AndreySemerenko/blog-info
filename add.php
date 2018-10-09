<?php
include_once ('model/news.php');
mylog();
$login = myLog();
if(!$login){
    header('Location:login.php');
    die;
}
$db = db_connect();

if(count($_POST) > 0){
    $title = trim($_POST['title']);
    $descr = trim($_POST['descr']);
    $istitle = uniqTitle($db,$title);

   if($title == '' || $descr == ''){
       $msg = "Заполните все поля";
   }
   elseif (!check_title($title)){
       $msg =  "Только латинские буквы и цифры!";
   }
   elseif($istitle == '0'){
       $msg = "Такой файл уже существует!";
   }
   else{
       news_add($db,$title,$descr);
       header('Location:index.php');
       exit();
   }
}
else{
    $title = '';
    $descr = '';
    $msg = 'write';
}
include_once ('view/v_add.php');

