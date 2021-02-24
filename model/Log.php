<?php
namespace Webapp\Model;

use Webapp\Config\Db\Database as Database;


    class Log {


        private static $table = "logs";
        
      
        private  static function getDb() 
        {
            return  new Database();
           
           
        }

        public static function getLog() {

            $data =  Self::getDb()->SelectAll("SELECT * FROM ".Self::$table." Order By date DESC");
            return $data;

        }


        public static function store($action,$user_id) {

    
            Self::getDb()->Insert("INSERT INTO ".Self::$table."(user_id,action,date) 
               values ( 
                   :user_id , 
                   :action,
                   :date

               )",[
                   'user_id' => $user_id,
                   'action' => $action,
                   'date' => date("Y-m-d H:i:s")
               ]
              );

        }



    }