<?php
namespace Core;
class Auth
{
    public static function  myLog(){
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
}