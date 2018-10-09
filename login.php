<?php
include_once ('model/news.php');
mylog();
$login = myLog();
if($login){
    header("Location:index.php");
    die;
}
if(count($_POST) > 0){
    if($_POST['name'] == 'admin' && $_POST['password'] == 'qwerty'){
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
    setcookie('name',hash('sha256','admin'),time(),'/');
    setcookie('password',hash('sha256','qwerty'),time(),'/');

}


include_once ('view/v_login.php');

