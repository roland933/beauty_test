<?php

use Webapp\Config\Db\Database as Database;
use Webapp\Model\Address as Address;
use Webapp\helper\Validation as Validation;
use Webapp\Model\Log as Log;
use Webapp\Auth\Auth as Auth;


class AddressController extends Address
{

    private $db;
    private $shipping_table = "shipping_address";
    private $billing_table = "billing_address";
    public $val;


    public function __construct()
    {
        $this->db = new Database();


    }

    public function addActions()
    {
        if (isset($_GET['action']) && $_GET['action'] == 'add') {

            $this->store();

        } else {

            $this->edit($_GET['type']);
            $this->update($_GET['address_id']);

        }
    }


    public function setTitle($type)
    {

        $type == "shipping" ? $type = "Szállítási" : $type = "Számlázási";

        if (isset($_GET['action']) && $_GET['action'] == 'add') {

            echo "<h5 class='heading'>Új " . $type . " cím</h5>";
        } else {

            echo "<h5 class='heading'>" . $type . " cím szerkesztése</h5>";
        }
    }


    public function fetchAllShippingAddress()
    {


        $data = $this->db->SelectAll("SELECT sa.id,sa.city,sa.name,sa.zipcode,sa.street,sa.set_default FROM" . " " . $this->shipping_table . " as sa 
        INNER JOIN users as u ON sa.user_id = u.id WHERE sa.user_id = :user_id", ["user_id" => Auth::user_id()]);


        return $data;


    }

    public function fetchAllBillingAddress()
    {

        $data = $this->db->SelectAll("
        SELECT ba.id, ba.tax_number, ba.name,ba.city,ba.zipcode, ba.region, ba.street FROM" . " " . $this->billing_table . " as ba 
        INNER JOIN users as u ON ba.user_id = u.id WHERE ba.user_id = :id", ["id" => Auth::user_id()]);
        return $data;
    }


    public function edit($type)
    {
        // Kiválaszott cím betöltése típus alapján.

        if ($type == "shipping") {

            $data = $this->db->Select("SELECT * FROM" . " " . $this->shipping_table . " as sa 
        WHERE sa.id = :id", ["id" => $_GET['address_id']]

            );

            $this->setDefault($data->set_default);
            $this->setName($data->name);
            $this->setCity($data->city);
            $this->setRegion($data->region);
            $this->setZipcode($data->zipcode);
            $this->setStreet($data->street);

        } else {

            $data = $this->db->Select("SELECT * FROM" . " " . $this->billing_table . " as ba
            WHERE ba.id = :id", ["id" => $_GET['address_id']]

            );

            $this->setName($data->name);
            $this->setCity($data->city);
            $this->setRegion($data->region);
            $this->setZipcode($data->zipcode);
            $this->setStreet($data->street);
            $this->setTaxNumber($data->tax_number);

        }

    }


    public function deleteAllShipping($user_id)
    {

        if (isset($_POST['delete'])) {

            foreach ($this->fetchAllShippingAddress() as $row) {

                $del = $this->db->Remove("Delete from" . " " . $this->shipping_table . " where id = :id", [
                    'id' => $row['id']

                ]);

            }

            Log::store('Összes szállítási cím törlésre került', $user_id);
            header("Location: address.php");

        }


    }

    public function deleteAddressById()
    {


        if (isset($_GET['delete_id']) && $_GET['type'] == 'shipping') {

            $id = $_GET['delete_id'];

            $this->db->Remove("Delete from" . " " . $this->shipping_table . " where id = :id", [
                'id' => $id

            ]);

            Log::store('' . $id . ' Sorszámú szállítási cím törölve lett', Auth::user_id());
            header("Location: address.php");

        }


        if (isset($_GET['delete_id']) && $_GET['type'] == 'billing') {

            $id = $_GET['delete_id'];

            $this->db->Remove("Delete from" . " " . $this->billing_table . " where id = :id", [
                'id' => $id

            ]);

            Log::store('' . $id . ' Sorszámú számlázási cím törölésre került', Auth::user_id());
            header("Location: address.php");

        }


    }


    public function deleteAllBillingAddress($user_id)
    {
        if (isset($_POST['delete_all_ba'])) {

            foreach ($this->fetchAllBillingAddress() as $row) {

                $this->db->Remove("Delete from" . " " . $this->billing_table . " where id = :id", [
                    'id' => $row['id']

                ]);


            }

            Log::store('Összes számlázási cím törlésre került', $user_id);
            header("Location: address.php?user_id=$user_id");

        }

    }


    public function update($id)
    {
        // Kiválasztott cím frissítése id alapján

        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_GET['type'] == 'shipping') {

            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
            $zipcode = filter_var($_POST['zipcode'], FILTER_SANITIZE_NUMBER_INT);
            $region = filter_var($_POST['regio'], FILTER_SANITIZE_STRING);
            $street = filter_var($_POST['street'], FILTER_SANITIZE_STRING);
            isset($_POST['default']) ? $default_addr = '1' : $default_addr = '0';

            $this->val = new Validation();

            $this->val->name($name);
            $this->val->zipcode($zipcode);
            $this->val->street($street);
            $this->val->regio($region);
            $this->val->city($city);

            if (!$this->val->errors) {

                $data = $this->db->Update("Update " . $this->shipping_table . " 
                set name = :name, region = :region, city = :city, zipcode = :zipcode, street = :street, set_default = :set_default
                WHERE id = :id", [
                        "id" => $id,
                        "name" => $name,
                        "region" => $region,
                        "city" => $city,
                        "zipcode" => $zipcode,
                        "street" => $street,
                        "set_default" => $default_addr

                    ]
                );


                if ($default_addr == '1') {
                    // Nem lehet két alapértelemzett cím
                    $this->db->Update(
                        "Update " . $this->shipping_table . " set set_default = :set_default
                         WHERE id != :id", [
                        "id" => $_GET['address_id'],
                        "set_default" => 0

                    ]);

                }


                $this->setDefault($default_addr);
                $this->setName($name);
                $this->setCity($city);
                $this->setZipcode($zipcode);
                $this->setRegion($region);
                $this->setStreet($street);

                Log::store('' . $id . ' Sorszámú szállítási cím frissítésre került', Auth::user_id());
                header("Location: address.php");

            }

        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_GET['type'] == 'billing') {

            //Számlázis cím frissítése
            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
            $zipcode = filter_var($_POST['zipcode'], FILTER_SANITIZE_NUMBER_INT);
            $region = filter_var($_POST['regio'], FILTER_SANITIZE_STRING);
            $street = filter_var($_POST['street'], FILTER_SANITIZE_STRING);
            $taxnumber = filter_var($_POST['taxnumber'], FILTER_SANITIZE_NUMBER_INT);

            $this->val = new Validation();
            $this->val->name($name);
            $this->val->zipcode($zipcode);
            $this->val->street($street);
            $this->val->regio($region);
            $this->val->city($city);


            if (empty($this->val->errors)) {

                $data = $this->db->Update("Update " . $this->billing_table . " 
                set name = :name, tax_number = :tax_number, region = :region, city = :city, zipcode = :zipcode, street = :street 
                WHERE id = :id", [
                        "id" => $id,
                        "name" => $name,
                        "tax_number" => $taxnumber,
                        "region" => $region,
                        "city" => $city,
                        "zipcode" => $zipcode,
                        "street" => $street

                    ]
                );

                $this->setName($name);
                $this->setCity($city);
                $this->setZipcode($zipcode);
                $this->setRegion($region);
                $this->setStreet($street);
                $this->setTaxNumber($taxnumber);

                Log::store('' . $id . ' Sorszámú számlázási cím frissítésre került', Auth::user_id());
                header("Location: address.php");

            }


        }

    }


    public function store()
    {

        $type = $_GET['type'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $this->val = new Validation();

            if ($type == 'billing') {

                $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);

                $taxnumber = filter_var($_POST['taxnumber'], FILTER_SANITIZE_NUMBER_INT);
                $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
                $zipcode = filter_var($_POST['zipcode'], FILTER_SANITIZE_NUMBER_INT);
                $region = filter_var($_POST['regio'], FILTER_SANITIZE_STRING);
                $street = filter_var($_POST['street'], FILTER_SANITIZE_STRING);
                $user_id = Auth::user_id();

                $this->val->name($name);
                $this->val->zipcode($zipcode);
                $this->val->street($street);
                $this->val->regio($region);
                $this->val->city($city);
                $this->val->taxNumber($taxnumber);

                $this->setName($name);
                $this->setCity($city);
                $this->setZipcode($zipcode);
                $this->setRegion($region);
                $this->setStreet($street);
                $this->setTaxNumber($taxnumber);


                if (empty($this->val->errors)) {


                    $this->db->Insert("INSERT INTO" . " " . $this->billing_table . "( 
                                     user_id ,
                                     name,
                                     tax_number,
                                     city,
                                     region,
                                     street,
                                     zipcode ) 
                                    values ( 
                                        :user_id , 
                                        :name,
                                        :tax_number,
                                        :city,
                                        :region,
                                        :street,
                                        :zipcode   
                                        
                                    )", [
                            'user_id' => $user_id,
                            'name' => $name,
                            'tax_number' => $taxnumber,
                            'city' => $city,
                            'region' => $region,
                            'street' => $street,
                            'zipcode' => $zipcode

                        ]
                    );

                    Log::store("Új számlázási cím felvételre került", $user_id);

                    header("Location: address.php");
                }


            } else {

                //Szállítási cím
                $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
                $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
                $zipcode = filter_var($_POST['zipcode'], FILTER_SANITIZE_NUMBER_INT);
                $region = filter_var($_POST['regio'], FILTER_SANITIZE_STRING);
                $street = filter_var($_POST['street'], FILTER_SANITIZE_STRING);

                isset($_POST['default']) ? $default_addr = '1' : $default_addr = '0';
                $user_id = Auth::user_id();

                $this->val->name($name);
                $this->val->zipcode($zipcode);
                $this->val->street($street);
                $this->val->regio($region);
                $this->val->city($city);

                $this->setDefault($default_addr);
                $this->setName($name);
                $this->setCity($city);
                $this->setZipcode($zipcode);
                $this->setRegion($region);
                $this->setStreet($street);

                if (empty($this->val->errors)) {

                    $this->db->Insert("INSERT INTO" . " " . $this->shipping_table . "( 
                    user_id ,
                    name,
                    region,
                    city,
                    zipcode,
                    street,
                    set_default
                     ) 
                   values ( 
                       :user_id, 
                       :name,
                       :region,
                       :city,
                       :zipcode,
                       :street,
                       :set_default  
                       
                   )", [
                            'user_id' => $user_id,
                            'name' => $name,
                            'region' => $region,
                            'city' => $city,
                            'zipcode' => $zipcode,
                            'street' => $street,
                            'set_default' => $default_addr,


                        ]
                    );


                    Log::store("Új szállítási  cím felvételre került", $user_id);

                    header("Location: address.php");


                }


            }


        }


    }
}