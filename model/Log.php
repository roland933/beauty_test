<?php

namespace Webapp\Model;
/****
 * Logolási folyamatot feldologozó osztály.
 */

use Webapp\Config\Db\Database as Database;


class Log
{


    private static $table = "logs";


    private static function getDb()
    {
        return new Database();


    }

    public static function getLog()
    {

        $data = self::getDb()->SelectAll("SELECT * FROM" ." ".self::$table. " Order By date DESC");
        return $data;

    }


    public static function store($action, $user_id)
    {


        self::getDb()->Insert("INSERT INTO" ." ".self::$table . "(user_id,action,date) 
               values ( 
                   :user_id , 
                   :action,
                   :date

               )", [
                'user_id' => $user_id,
                'action' => $action,
                'date' => date("Y-m-d H:i:s")
            ]
        );

    }


}