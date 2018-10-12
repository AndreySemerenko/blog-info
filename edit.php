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
    $title = (trim($_POST['title']) != '') ? trim($_POST['title']) : false;
    $descr = (trim($_POST['descr']) != '') ? trim($_POST['descr']) : false;
    $title1 = isset($_GET['fname']) ? trim($_GET['fname']) : false;
    $del = isset($_POST['delete']) ? true : false;
    $id = isset($_GET['id']) ? true : false;
    $contents =  get_descr($db,$title1);
    if($del){
        news_del($db,$title1);
        header('Location:edit1.php');
        exit();
    }
    $istitle = uniqTitle($db,$title);
    $errors = news_validate($title,$descr,$istitle);
    if(count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
    else {
        if($title1){
            news_update($db,$title,$descr,$title1);
            header('Location:index.php');
            exit();
        }
    }
}
else{
    $title1 = $_GET['fname'];
    $contents =  get_descr($db,$title1);
    $errors = [];
    if(!isset($title1)){
        echo 'не передано название.ошибка';
    }
    elseif((check_title($title1))){
       echo  "Только русские буквы и цифры!";
    }

     elseif(!$title1){
     echo "Файл не найден";
}
}
$content = template('view/v_edit.php',['title1' => $title1,'contents' => $contents]);
$html = template('view/v_main.php',['content' => $content,'title' => 'Редактировать новость']);
echo $html;







