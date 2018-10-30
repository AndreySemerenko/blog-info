<?php

namespace Model;

class NewsModel extends MainModel
{
    public static $instance;

    public static function Instance()
    {
        if(self::$instance == null){
            self::$instance = new NewsModel();
        }

        return self::$instance;

    }

    public function __construct()
    {
        parent::__construct();
        $this->pk = 'title';
        $this->table = 'mynews';
    }


public function news_update($title, $descr, $title1)
    {
        $queryu = $this->db->prepare("UPDATE mynews SET  {$this->pk}='$title' , descr='$descr' WHERE {$this->pk} = '$title1'");
        $queryu->execute();
        if ($queryu->errorCode() != \PDO::ERR_NONE) {
            $info = $queryu->errorInfo();
            echo implode('<br>', $info);
            die();
        }
        return $this->db->lastInsertId();
    }

public function add($title, $descr)
    {
        $query = $this->db->prepare("INSERT INTO {$this->table} ({$this->pk},descr) VALUES('$title', '$descr')");
        $query->execute();
        if ($query->errorCode() != \PDO::ERR_NONE) {
            $info = $query->errorInfo();
            echo implode('<br>', $info);
            die();
        } else {
            return $this->db->lastInsertId();
        }
    }

public function uniqTitle($title)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->pk} = \"$title\" ";
        $query2 = $this->db->prepare($sql);
        $query2->execute();
        $res = $query2->fetch();
        $istitle = false;
        if (!$res) {
            return $istitle = true;
        } else {
            return $istitle = false;
        }
    }

    public function check_title($title)
    {
        return preg_match('/[a-z0-9]+/i', $title);
    }

    public function validate($title, $descr, $istitle)
    {
        $errors = [];
        if ($title = '') {
            $errors[] = "Заполните имя ";
        } elseif ($descr = '') {
            $errors[] = "Заполните контент ";
        } elseif ($this->check_title($title)) {
            $errors[] = "Только русские буквы и цифры!";
        } elseif (!$istitle) {
            $errors[] = "Такой файл уже существует!";
        }
        return $errors;
    }


}
