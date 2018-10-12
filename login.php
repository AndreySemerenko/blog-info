<?php
session_start();
include_once ('model/news.php');
include_once ('model/database.php');
include_once ('model/system.php');
$login = myLog();
if($login){
    header("Location:index.php");
    die;
}
if(count($_POST) > 0){
    $name = $_POST['name'];
    $password = $_POST['password'];
    if($name == 'admin' && $password == 'qwerty'){
        $_SESSION['log'] = true;
        if(isset($_POST['remember'])){
            setcookie('name',hash('sha256','admin'),time() + 3600 * 24 * 7 ,'/');
            setcookie('password',hash('sha256','qwerty'),time() + 3600 * 24 * 7 ,'/');
        }
        header('Location:index.php');
        exit();
    }
    else{
        echo 'Не правильный пароль или имя';
    }

}
else{
    unset($_SESSION['log']);
    setcookie('name','',time(),-1);
    setcookie('password','',time() - 1);

}


$content = template('view/v_login.php');
$html = template('view/v_main.php',['content' => $content,'title' => 'Авторизация пользователя']);
echo $html;

