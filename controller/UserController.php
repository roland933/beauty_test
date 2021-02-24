<?php

use Webapp\Model\User as User;
use Webapp\Config\Db\Database as Database;
use Webapp\Model\Log as Log;
use Webapp\helper\Validation as Validation;

class UserController extends User
{

    private $db;
    private $table = "users";
    public $val;

    public function __construct()
    {

        $this->db = new Database();

    }


    public function show()
    {

        $data = $this->db->select("SELECT * FROM " . $this->table . " Where id = 1");

        $this->setId($data->id);
        $this->setFirstname($data->first_name);
        $this->setLastname($data->last_name);
        $this->setEmail($data->email);
        $this->setPassword($data->password);

    }


    public function update()
    {

        if (isset($_POST['update_user'])) {

            var_dump($_POST['user_id']);
            $id = $_POST['user_id'];
            $this->val = new Validation();

            $fname = filter_var($_POST['fname'],FILTER_SANITIZE_STRING);
            $lname = filter_var($_POST['lname'],FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
            $psw = $_POST['password'];

            $this->val->email($email);
            $this->val->firstName($fname);
            $this->val->lastName($lname);


            if(empty($this->val->errors)) {

                $this->db->Update("UPDATE " . $this->table . " 
                set first_name = :first_name, last_name = :last_name, email = :email, password = :password
                WHERE id = :id", [
                        "id" => $id,
                        "first_name" => $fname,
                        "last_name" => $lname,
                        "email" => $email,
                        "password" => $psw,
                    ]
                );

                $_SESSION['message']= "Sikeres frissítés";





                Log::store('Személyes adat frissitése', $id);
                header("Location: index.php");

            }

        }


    }


}