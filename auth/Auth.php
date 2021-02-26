<?php
namespace Webapp\Auth;
use Webapp\Config\Db\Database as Database;

class Auth
{

    private static $db;
    private static $table = "users";

    private function getDb()
    {
        self::$db = new Database();
    }

    public static function isAuth()
    {

        if (!isset($_SESSION['user_id'])) {

            return false;
        }

        return true;

    }


    public static function redirect()
    {

        if (!self::isAuth()) {
            header("Location:index.php");
        }

    }

    public static function user_id()
    {
        if (self::isAuth()) {
            return $_SESSION['user_id'];
        }

    }


    public static function name()
    {
        self::getDb();

        if (self::isAuth()) {
            $data = self::$db->select("SELECT * FROM" . " " . self::$table . " Where id = :id", ['id' => self::user_id()]);
            return $data->first_name . " " . $data->last_name;
        }

    }

}