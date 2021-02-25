<?php
    class Auth {

        public static function isAuth()
        {

            if(!isset($_GET['user_id']))
            {
                return false;
            }

            return true;

        }

    }