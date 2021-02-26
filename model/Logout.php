<?php

    class Logout {


        public static function exit() {
            session_destroy();
            header('Location:index.php?logout=success');

        }

    }