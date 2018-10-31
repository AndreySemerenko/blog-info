<?php

namespace Core;

class App
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function go()
    {
        $params = $this->getParamByRequest();
        if(!$params){
           $params = $this->getParamByParams('default');
        }
        $ctrl = new $params['controller']($this->request);
        $action = $params['action'];
        $ctrl->$action();
        $ctrl->render();
    }

    private function getParamByRequest()
    {
        return isset($this->routs()[$this->request->getRout()])? $this->routs()[$this->request->getRout()]: false;
    }
    private function getParamByParams($rout)
    {
        return isset($this->routs()[$rout])? $this->routs()[$rout]: false;
    }

    private function routs()
    {
        return [
            "/" => [
                'controller' => 'Controllers\ArticleController',
                'action' => 'indexAction'
            ],
            "/post" => [
                'controller' => 'Controllers\ArticleController',
                'action' => 'postAction'
            ],
            "/login" => [
                'controller' => 'Controllers\ArticleController',
                'action' => 'loginAction'
            ],
            "/add" => [
                'controller' => 'Controllers\ArticleController',
                'action' => 'addAction'
            ],
            "/edit1" => [
                'controller' => 'Controllers\ArticleController',
                'action' => 'edit1'
            ],
            "/edit" => [
                'controller' => 'Controllers\ArticleController',
                'action' => 'editAction'
            ],
            "/logout" => [
                'controller' => 'Controllers\ArticleController',
                'action' => 'logoutAction'
            ],
            "default" => [
                'controller' => 'Controllers\ArticleController',
                'action' => 'get404'
            ]

        ];
    }
}