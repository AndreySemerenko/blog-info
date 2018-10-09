<?php
include_once ('model/news.php');
myLog();
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
    if($del){
        news_del($db,$title1);
        header('Location:edit1.php');
        exit();
    }
    $istitle = uniqTitle($db,$title);

    if(!$title || !$descr && !$del){
        $msg = 'Заполните все поля:';
        if(!$title) {
            $msg .= ' title';
        }

        if(!$descr) {
            $msg .= ' description';
        }
        echo $msg .'<br/>';
    }

    if ($title && !check_title($title)){
        echo  "Только латинские буквы и цифры!<br/>";
    }

    if($istitle == '0'){
        echo "Такой файл уже существует!<br/>";
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
    if(!isset($title1)){
        echo 'не передано название.ошибка';
    }
    elseif(!(check_title($title1))){
       echo  "Только латинские буквы и цифры!";
    }

     elseif(!$title1){
     echo "Файл не найден";
}
}
include_once ('view/v_edit.php');







