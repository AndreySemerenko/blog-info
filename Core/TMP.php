<?php
namespace Core;
class TMP
{
    public static function template($path, $vars = []){
        ob_start();
        extract($vars);
        include($path);
        $res = ob_get_clean();
        return $res;
    }
}
