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
    public $firstNameErr = '';
    public $lastNameErr = '';
    public $passwordErr = "";
    public $taxNumberErr = '';
    public $rePassErr = "";


    public function emailMatch($email)
    {

        if ($email) {
            $this->emailErr = "Ez az email cím már létezik!";
            return $this->errors[] = [$this->emailErr];

        }
    }

    public function passwordMatch($val1, $val2)
    {

        if ($val1 !== $val2) {
            $this->rePassErr = "A két jelszó nem egyezik!";
            return $this->errors[] = [$this->rePassErr];

        }
    }

    public function taxNumber($val)
    {
        var_dump($val);
        if (!empty($val) && strlen($val) !== 11) {
            $this->taxNumberErr = "Érvénytelen adószám!";
            return $this->errors[] = [$this->taxNumberErr];
        }

    }

    public function password($val)
    {
        if (empty($val)) {

            $this->passwordErr = "A mező kitöltése kötelező!";
            return $this->errors[] = [$this->passwordErr];
        } elseif (strlen($val) < 4) {
            $this->passwordErr = "A jelszó túl rövid!";
            return $this->errors[] = [$this->passwordErr];
        }
    }

    public function firstName($val)
    {
        if (empty($val)) {

            $this->firstNameErr = "A mező kitöltése kötelező!";
            return $this->errors[] = [$this->firstNameErr];
        } else if (strlen($val) < 3) {
            $this->firstNameErr = "A megadott érték túl rövid!";
            return $this->errors[] = [$this->firstNameErr];
        } else if (preg_match('/[0-9]/',$val)) {
            $this->firstNameErr = "A mező nem tartalmazhat számokat";
            return $this->errors[] = [$this->firstNameErr];
        }

    }

    public function lastName($val)
    {
        if (empty($val)) {

            $this->lastNameErr = "A mező kitöltése kötelező!";
            return $this->errors[] = [$this->lastNameErr];
        } else if (strlen($val) < 3 ) {
            $this->lastNameErr = "A megadott érték túl rövid!";
            return $this->errors[] = [$this->lastNameErr];
        } else if (preg_match('/[0-9]/',$val)) {
            $this->lastNameErr = "A mező nem tartalmazhat számokat";
            return $this->errors[] = [$this->lastNameErr];
        }

    }


    public function name($val)
    {

        if (empty($val)) {

            $this->nameErr = "A mező kitöltése kötelező!";
            return $this->errors[] = [$this->nameErr];
        }


    }


    public function email($val)
    {

        if (empty($val)) {
            $this->emailErr = "A mező kitöltése kötelező!";
            return $this->errors[] = [$this->emailErr];
        } else if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
            $this->emailErr = "Érvénytelen email cím!";
            return $this->errors[] = [$this->emailErr];
        }
    }


    public function zipcode($val)
    {


        if (empty($val)) {

            $this->zipcodeErr = "A mező kitöltése kötelező!";
            return $this->errors[] = [$this->zipcodeErr];

        } else if (!empty($val) && strlen($val) !== 4) {

            $this->zipcodeErr = "Érvénytelen irányítószám!";
            return $this->errors[] = [$this->zipcodeErr];


        }


    }


    public function street($val)
    {


        if (empty($val)) {
            $this->streetErr = "A mező kitöltése kötelező!";
            return $this->errors[] = [$this->streetErr];

        } else if (strlen($val) < 5) {
            $this->streetErr = "A mező nem lehet kevesebb 5 karakternél!";
            return $this->errors[] = [$this->streetErr];
        }


    }


    public function city($val)
    {
        if (empty($val)) {
            $this->cityErr = "A mező kitöltése kötelező!";
            return $this->errors[] = [$this->cityErr];
        } else if (preg_match('/[0-9]/',$val)) {
            $this->cityErr = "A mező nem tartalmazhat számokat";
            return $this->errors[] = [$this->cityErr];
        }


    }


    public function regio($val)
    {

        if (empty($val)) {
            $this->regioErr = "A mező kitöltése kötelező!";
        }else if (preg_match('/[0-9]/',$val)) {
            $this->regioErr = "A mező nem tartalmazhat számokat";
            return $this->errors[] = [$this->regioErr];
        }


    }


}

