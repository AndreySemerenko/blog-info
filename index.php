<?php
session_start();
function __autoload($name)
{
    include_once str_replace("\\",DIRECTORY_SEPARATOR,$name) . ".php";
}
$request = new Core\Request($_GET,$_POST,$_SERVER);
$app = new Core\App($request);
$app->go();


