<?php

namespace Controllers;
use Core\Auth;
use Core\TMP;
use Core\Request;

abstract class BaseController
{
    protected $content;
    protected $login;
    protected $title;
    protected $request;

    public function __construct(Request $request)
    {
        $this->login = Auth::myLog();
        $this->request = $request;
    }
    public function get404()
    {
        $this->title = "{$this->title}::404 error";
        $this->content = "<h3>Page not found</h3>";
        $this->render();
        die;
    }


    public function render()
    {
       echo TMP::template('view/v_main.php',['content' => $this->content,'title' => $this->title,'login' => $this->login]);
    }
}