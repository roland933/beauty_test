<?php

use Webapp\Config\Db\Database as Database;

class Login {

    private $db;


    public function __construct()
    {
        $this->db = new Database();
    }

    public function action()
    {

        if (isset($_POST['login'])) {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $psw = trim($_POST['password']);
            $user = $this->db->Select("SELECT * FROM users WHERE email = '$email'");

            if($user) {
                if(password_verify($psw,$user->password)) {
                    header("Location:index.php");
                    $_SESSION['user_id']= $user->id;
                    $_SESSION['name'] = $user->first_name." ".$user->last_name;

                } else {
                    $_SESSION['error'] = "Sikertelen bejelentkezés";
                }
            }
        }

    }



}