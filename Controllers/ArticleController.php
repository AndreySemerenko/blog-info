<?php

namespace Controllers;

use Core\Request;
use Model\NewsModel;
use Core\TMP;

class ArticleController extends BaseController
{

    public function indexAction()
    {
        $mNews = NewsModel::Instance();
        $news = $mNews->all();
        $this->title="Новости";
        $this->content = TMP::template('view/v_index.php', ['news' => $news, 'login' => $this->login,'title' => $this->title]);
    }
    public function editAction()
    {
        if(!$this->login){
            header('Location:/login');
            die;
        }
        if(count($this->request->getPost()) > 0){
            $title = (trim($this->request->getPost()['title']) != '') ? trim($this->request->getPost()['title']) : false;
            $descr = (trim($this->request->getPost()['descr']) != '') ? trim($this->request->getPost()['descr']) : false;
            $title1 = urldecode($this->request->getGet()['fname']) != null ? trim(urldecode($this->request->getGet()['fname'])) : false;
            $del = isset($this->request->getPost()['delete']) ? true : false;
            $id = isset($this->request->getGet()['id']) ? true : false;
            $contents =  NewsModel::Instance()->get_descr($title1);
            if($del){
                NewsModel::Instance()->del($title1);
                header('Location:/edit1');
                exit();
            }
            $istitle = NewsModel::Instance()->uniqTitle($title);
            $errors = NewsModel::Instance()->validate($title,$descr,$istitle);
            if(count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
            }
            else {
                if($title1){
                    NewsModel::Instance()->news_update($title,$descr,$title1);
                    header('Location:/');
                    exit();
                }
            }
        }
        else{
            $title1 = urldecode($this->request->getGet()['fname']);
            $contents =  NewsModel::Instance()->get_descr($title1);
            $errors = [];
            if(!isset($title1)){
                echo 'не передано название.ошибка';
            }
            elseif((NewsModel::Instance()->check_title($title1))){
                echo  "Только русские буквы и цифры!";
            }

            elseif(!$title1){
                echo "Файл не найден";
            }
        }
        $this->title = "Добавить новость";
        $this->content = TMP::template('view/v_edit.php',['title1' => $title1,'contents' => $contents]);
    }
    public function edit1()
    {
        if(!$this->login){
            header('Location:/login');
            die;
        }
        $this->title = "Выберете новость";
        $list = NewsModel::Instance()->all();
        $this->content = TMP::template('view/v_edit1.php',['list' => $list]);
    }
     public function addAction()
     {
         if(!$this->login){
             header('Location:/login');
             die;
         }
         if(count($this->request->getPost()) > 0){
             $title = trim($this->request->getPost()['title']);
             $descr = trim($this->request->getPost()['descr']);
             $istitle = NewsModel::Instance()->uniqTitle($title);
             $errors = NewsModel::Instance()->validate($title,$descr,$istitle);
             if(count($errors) > 0) {
                 foreach ($errors as $error) {
                     echo "<p>$error</p>";
                 }
             } else{
                 NewsModel::Instance()->add($title,$descr);
                 header('Location:/');
                 exit();
             }
         } else{
             $title = '';
             $descr = '';
             $msg = 'write';
             $errors = [];
         }
         $this->title= "Добавить новость";
         $this->content = TMP::template('view/v_add.php',['title' => $title, 'descr' => $descr]);


     }
     public function logoutAction(){
         $_SESSION['log'] = false;
         setcookie('name',hash('sha256','admin'),time(),'/');
         setcookie('password',hash('sha256','qwerty'),time(),'/');
         header('Location:/');
         exit();
     }
    public function postAction()
    {
        if(!$this->login){
            header('Location:/login');
            die;}

            if(urldecode($this->request->getGet()['fname']) == null){
                $this->get404();
            }
        $this->title = "Новость";
        $contents = NewsModel::Instance()->get_descr(urldecode($this->request->getGet()['fname']));
        if(!$contents){
            $this->get404();
        }
        $this->content = TMP::template('view/v_post.php',['contents' => $contents,'fname' => urldecode($this->request->getGet()['fname'])]);
    }
    public function loginAction()
    {
        if($this->login){
            header("Location:/");
            die;
        }
        if(count($this->request->getPost()) > 0){
            $name = $this->request->getPost()['name'];
            $password = $this->request->getPost()['password'];
            if($name == 'admin' && $password == 'qwerty'){
                $_SESSION['log'] = true;
                if(isset($this->request->getPost()['remember'])){
                    setcookie('name',hash('sha256','admin'),time() + 3600 * 24 * 7 ,'/');
                    setcookie('password',hash('sha256','qwerty'),time() + 3600 * 24 * 7 ,'/');
                }
                header('Location:/');
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
        $this->title = 'Авторизация пользователя';
        $this->content = TMP::template('view/v_login.php');
    }
}