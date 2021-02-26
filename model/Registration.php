<?php

use Webapp\Config\Db\Database as Database;
use Webapp\Model\User as User;
use Webapp\Helper\Validation;

/***
 * Class Registration
 */
class Registration
{

    private $db;
    public $val;
    public $user;
    private $table = 'users';

    public function __construct()
    {

        $this->db = new Database();

    }

    public function action()
    {

        if (isset($_POST['reg'])) {

            $this->val = new Validation();

            $fname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
            $lname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $psw = $_POST['password'];
            $repass = $_POST['repass'];

            $hash = password_hash($psw, PASSWORD_DEFAULT);
            $this->val->firstName($fname);
            $this->val->lastName($lname);
            $this->val->email($email);
            $this->val->password($psw);
            $this->val->passwordMatch($psw, $repass);

            $user_email = $this->db->Select("SELECT * FROM"." ".$this->table. " WHERE email = :email",['email' => $email]);
            $this->val->emailMatch($user_email);

            $this->user = new User();

            $this->user->setEmail($email);
            $this->user->setFirstname($fname);
            $this->user->setLastname($lname);
            $this->user->setPassword($psw);

            if (empty($this->val->errors)) {

                $user = $this->db->Insert("INSERT INTO" . " " . $this->table . "( 
                                first_name,
                                last_name,
                                email,
                                password         
                                 ) 
                               values ( 
                                   :first_name,
                                   :last_name,
                                   :email,
                                   :password
                               )", [
                        'first_name' => $fname,
                        'last_name' => $lname,
                        'email' => $email,
                        'password' => $hash,


                    ]
                );


               var_dump($user);

               $_SESSION['user_id'] = $user;
               $_SESSION['name']= $this->user->getName();
               header("Location: index.php");

            }


        }


    }

}