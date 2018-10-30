<?php
namespace Core;

 class DB
 {
     private static $db;

     public static function Instance()
     {
         if(self::$db == null){
             self::$db = self::get();
         }
         return self::$db;
     }
      private static function get(){
         $db = new \PDO('mysql:host=localhost;dbname=news','root','');
         $db->exec('SET NAME UTF8');
         return $db;
     }
 }