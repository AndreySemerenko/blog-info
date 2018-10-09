<?php
error_reporting(E_ALL);
function news_all($db){
    $query = $db->prepare("SELECT * FROM mynews ORDER BY ad_dt DESC ");
    $query->execute();
    if($query->errorCode() != PDO::ERR_NONE){
        $info=$query->errorInfo();
        echo implode('<br>',$info);
        die();
    }
    $news = $query->fetchAll();
    return $news;

}
function myLog(){
    if(!(isset($_SESSION['log']) && $_SESSION['log'])){
        session_start();
        if(isset($_COOKIE['name']) == hash('sha256','admin') &&  isset($_COOKIE['password']) == hash('sha256','qwerty')){
            return $_SESSION['log'] = true;
        }
        else{
            return false;
        }
    }
    else{
        return true;
    }
}
function uniqTitle($db,$title){
    $sql = "SELECT * FROM mynews WHERE title = \"$title\" ";
    $query2 = $db->prepare($sql);
    $query2->execute();
    $res = $query2->fetch();

    if(!$res){
        return $istitle = '1';
    }
    else{
        return $istitle = '0';
    }
}
function news_add($db,$title,$descr){
    $query = $db->prepare("INSERT INTO mynews (title,descr) VALUES('$title', '$descr')");
    $query->execute();
    if($query->errorCode() != PDO::ERR_NONE){
        $info=$query->errorInfo();
        echo implode('<br>',$info);
        die();
    }
    else{
        return $db ->lastInsertId();
    }
}
function check_title($title){
    return preg_match("/^[a-zA-Z0-9]+$/", $title);
}
function news_del($db,$title1){
    $queryd = $db->prepare('DELETE FROM mynews WHERE title="'.$title1.'"');
    $queryd->execute();
    if($queryd->errorCode() != PDO::ERR_NONE){
        $info= $queryd->errorInfo();
        echo implode('<br>',$info);
        die();
    }
    return $db ->lastInsertId();
}
function news_update($db,$title,$descr,$title1){
    $queryu = $db->prepare("UPDATE mynews SET  title='$title' , descr='$descr' WHERE title = '$title1'");
    $queryu->execute();
    if($queryu->errorCode() != PDO::ERR_NONE){
        $info=$queryu->errorInfo();
        echo implode('<br>',$info);
        die();
    }
    return $db ->lastInsertId();
}
function get_descr($db,$title1){
    $query = $db->prepare("SELECT descr FROM mynews WHERE title='$title1'");
    $query->execute();
    if($query->errorCode() != PDO::ERR_NONE){
        $info->$query->errorInfo();
        echo implode('<br>',$info);
        die();
    }
    $contents = $query->fetch()['descr'];
    return $contents;
}
function db_connect(){
    $db = new PDO('mysql:host=localhost;dbname=news','root','');
    $db->exec('SET NAME UTF8');
    return $db;
}