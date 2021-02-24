<?php

namespace Webapp\helper;

class Validation
{

    public $errors = [];
    public $nameErr = '';
    public $zipcodeErr = '';
    public $streetErr = '';
    public $cityErr = '';
    public $regioErr = '';
    public $emailErr = '';
    public $firstMameErr = '';
    public $lastNameErr = '';


    public function firstName($val)
    {
        if (empty($val)) {

            $this->firstMameErr = "A mező kitöltése kötelező";
            return $this->errors[] = [$this->firstMameErr];
        }

    }

    public function lastName($val)
    {
        if (empty($val)) {

            $this->lastNameErr = "A mező kitöltése kötelező";
            return $this->errors[] = [$this->lastNameErr];
        }

    }



    public function name($val)
    {

        if (empty($val)) {

            $this->nameErr = "A mező kitöltése kötelező";
            return $this->errors[] = [$this->nameErr];
        }


    }


    public function email($val)
    {
        if (empty($val)) {
            $this->emailErr = "A mező kitöltése kötelező";
            return $this->errors[] = [$this->emailErr];
        } else if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
            $this->emailErr = "Érvénytelen email cím";
            return $this->errors[] = [$this->emailErr];
        }
    }


    public function zipcode($val)
    {


        if (empty($val)) {

            $this->zipcodeErr = "A mező kitöltése kötelező";
            return $this->errors[] = [$this->zipcodeErr];

        } else if (!empty($val) && strlen($val) !== 4) {

            $this->zipcodeErr = "Érvénytelen irányítószám";
            return $this->errors[] = [$this->zipcodeErr];


        }


    }


    public function street($val)
    {


        if (empty($val)) {
            $this->streetErr = "A mező kitöltése kötelező!";

        } else if (strlen($val) < 5) {
            $this->streetErr = "A mező nem lehet kevesebb 5 karakternél!";

        }


    }


    public function city($val)
    {

        if (empty($val)) {

            $this->cityErr = "A mező kitöltése kötelező";

        }


    }


    public function regio($val)
    {

        if (empty($val)) {

            $this->regioErr = "A mező kitöltése kötelező";

        }


    }


}

