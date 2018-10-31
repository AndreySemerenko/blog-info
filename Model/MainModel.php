<?php
namespace Model;

use Core\SQL;


abstract class MainModel
{
    protected $db;
    protected $table;
    protected $pk;

    protected function __construct()
    {
     $this->db = SQL::Instance();
    }

    public function all()
    {
        return $this->db->query("SELECT * FROM {$this->table}");
    }
    public function get_descr($title1){
        $query = $this->db->query("SELECT * FROM {$this->table} WHERE {$this->pk} LIKE '". $title1 . "%'");
       return $query[0]['descr'];
    }
    public function del($title1){
        $table = $this->table;
        $where = $this->pk  . '= ' . "'$title1'";

        $this->db->delete($table,$where);
    }

}