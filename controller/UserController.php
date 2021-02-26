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


    public function show($id)
    {

        $data = $this->db->select("SELECT * FROM" . " " . $this->table . " Where id = $id");

        $this->setId($data->id);
        $this->setFirstname($data->first_name);
        $this->setLastname($data->last_name);
        $this->setEmail($data->email);
        $this->setPassword($data->password);

    }


    public function showMessage() {

        if(isset($_SESSION['password_err'])) {
           return '<div class="alert alert-danger">'.$_SESSION['password_err'].'</div>';

        } else if(isset($_SESSION['warrning'])) {

            return '<div class="alert alert-warning">'.$_SESSION['warrning'].'</div>';

        } else if(isset($_GET['update'])) {
            return '<div class="alert alert-success">Sikeres módosítás!</div>';
        }





    }


    public function update($id)
    {

        if (isset($_POST['update_user'])) {

            $this->val = new Validation();

            $fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
            $lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $psw = $_POST['password'];
            $hash = password_hash($psw, PASSWORD_BCRYPT);

            $this->val->email($email);
            $this->val->firstName($fname);
            $this->val->lastName($lname);
            $this->val->password($psw);

            if (!password_verify($psw, $this->getPassword())) {
                $_SESSION['password_err']='Hibás jelszót adtál meg!';
                return false;
            }

            if ($fname != $this->getFirstname() || $lname != $this->getLastname() || $email != $this->getEmail()) {

                if (empty($this->val->errors)) {

                    $this->db->Update("UPDATE " . $this->table . " 
                set first_name = :first_name, last_name = :last_name, email = :email, password = :password
                WHERE id = :id", [
                            "id" => $id,
                            "first_name" => $fname,
                            "last_name" => $lname,
                            "email" => $email,
                            "password" => $hash,
                        ]
                    );


                    Log::store('Személyes adatok frissítésre kerültek', $id);
                    header("Location: index.php?update=true");

                }

            } else {
                $_SESSION['warrning'] = 'Nem történt változtatás';
                return false;
            }

        }

    }


}