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
        $table = $this->table;
        $where = $this->pk  . '= ' . "'$title1'";
        $object = ['descr' => $descr, 'title' => $title];
        return $this->db->update($table,$object,$where);
    }



public function add($title, $descr)
    {
        $table = $this->table;
        $object = ['descr' => $descr, $this->pk => $title];
        return $this->db->insert($table,$object);

    }

public function uniqTitle($title)
    {
        $res = $this->db->query("SELECT * FROM {$this->table} WHERE {$this->pk} = \"$title\" ");
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
