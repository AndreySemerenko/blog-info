<?php
error_reporting(E_ALL);
function myLog(){
    if(!(isset($_SESSION['log']) && $_SESSION['log'])){
        if(isset($_COOKIE['name']) == hash('sha256','admin') &&  isset($_COOKIE['password']) == hash('sha256','qwerty')){
            return $_SESSION['log'] = true;
        }
        else{
            return false;
        }
    }
    else{
        return  true;
    }
}
function uniqTitle($db,$title){
    $sql = "SELECT * FROM mynews WHERE title = \"$title\" ";
    $query2 = $db->prepare($sql);
    $query2->execute();
    $res = $query2->fetch();

    if(!$res){
        return $istitle = true;
    }
    else{
        return $istitle = false;
    }
}

function check_title($title){
    return preg_match('/[a-z0-9]+/i', $title);
}
function news_validate($title,$descr,$istitle){
    $errors = [];
    if($title =''){
        $errors[] = "Заполните имя ";
    }
    elseif($descr = ''){
        $errors[] = "Заполните контент ";
    }
    elseif (check_title($title)){
        $errors[] =  "Только русские буквы и цифры!";
    }
    elseif (!$istitle){
        $errors[] = "Такой файл уже существует!";
    }
    return $errors;
 }