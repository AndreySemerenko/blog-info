<?php
session_start();
include_once ('model/news.php');
include_once ('model/database.php');
include_once ('model/system.php');
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
    $errors = news_validate($title,$descr,$istitle);
   if(count($errors) > 0) {
       foreach ($errors as $error) {
           echo "<p>$error</p>";
       }
   } else{
       news_add($db,$title,$descr);
       header('Location:index.php');
       exit();
   }
} else{
    $title = '';
    $descr = '';
    $msg = 'write';
    $errors = [];
}
$content = template('view/v_add.php',['title' => $title, 'descr' => $descr]);
$html = template('view/v_main.php',['content' => $content,'title' => 'Добавить новость']);
echo $html;

