<?php
namespace Model;

use Core\DB;


abstract class MainModel
{
    protected $db;
    protected $table;
    protected $pk;

    protected function __construct()
    {
     $this->db = DB::Instance();
    }

    public function all()
    {
        $query = $this->db->prepare("SELECT * FROM {$this->table}");
        $query->execute();
        if ($query->errorCode() != \PDO::ERR_NONE) {
            $info = $query->errorInfo();
            echo implode('<br>', $info);
            die();
        }
        $result = $query->fetchAll();
        return $result;
    }
    public function get_descr($title1){

        $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$this->pk} LIKE '". $title1 . "%'");
        $query->execute();
        if($query->errorCode() != \PDO::ERR_NONE){
            $info=$query->errorInfo();
            echo implode('<br>',$info);
            die;
        }
        $contents = $query->fetch()['descr'];
        return $contents;
    }
    public function del($title1){
        $queryd = $this->db->prepare("DELETE FROM {$this->table} WHERE {$this->pk}= '$title1'");
        $queryd->execute();
        if($queryd->errorCode() != \PDO::ERR_NONE){
            $info= $queryd->errorInfo();
            echo implode('<br>',$info);
            die();
        }
        return $this->db ->lastInsertId();
    }

}