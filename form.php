<?php

require_once "config/Database.php";
require "model/Address.php";
require_once "helper/Validation.php";
require_once "model/Log.php";
require "controller/AddressController.php";

use Webapp\Config\Db\Database as Database;

$db = new Database();

$address = new AddressController($db);
$user_id = $_GET['user_id'];

if (isset($_GET['action']) && $_GET['action'] == 'add') {

    $address->store();

} else {


    $address->edit($_GET['type']);
    $address->update($_GET['address_id']);

}


?>

<!doctype html>
<html lang="en">
<?php require "inc/head.php"; ?>
<body>
<div class="page">
    <div class="container">
        <?php include('inc/navigation.php'); ?>
        <div class="content">
            <div class="col-xl-12">

                <div class="form-header mb-5 mt-3"><?php $address->setTitle($_GET["type"]); ?></div>

                <form method="post" action="">
                    <!-- <?php if (!empty($address->val->errors)): ?>
                <div class="alert"><?php echo $address->val->errors; ?> </div>
                <?php endif; ?> -->
                    <div class="row">

                        <div class="col-xl-12 form-group">
                            <label for="">Név: <span class="text-danger">*</span></label>
                            <input type="text"
                                   value="<?php echo $address->getName(); ?>"
                                   name="name"
                                   class="form-control"
                                   id=""
                                   placeholder="Teljes név">
                            <?php if (!empty($address->val->nameErr)): ?>
                                <span class="error"><?php echo $address->val->nameErr; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if (isset($_GET['type']) && $_GET['type'] === 'billing'): ?>
                        <div class="form-group">
                            <label for="">Adószám: </label>
                            <input type="text"
                                   value=""
                                   class="form-control"
                                   name="taxnumber"
                                   id=""
                                   placeholder="xxxx">

                        </div>

                    <?php endif; ?>
                    <div class="row">

                        <div class="col-xl-6 form-group">
                            <label for="">Megye : <span class="text-danger">*</span></label>
                            <input type="text"
                                   value="<?php echo $address->getRegion() ?>"
                                   name="regio"
                                   class="form-control"
                                   id=""
                                   placeholder="Csongrád">

                            <?php if (!empty($address->val->regioErr)): ?>
                                <span class="error"><?php echo $address->val->regioErr; ?></span>
                            <?php endif; ?>

                        </div>
                        <div class="col-xl-6 form-group">
                            <label for="">Város: <span class="text-danger">*</span></label>

                            <input type="text"
                                   value="<?php echo $address->getCity() ?>"
                                   name="city"
                                   class="form-control"
                                   id=""
                                   placeholder="Szeged">

                            <?php if (!empty($address->val->cityErr)): ?>
                                <span class="error"><?php echo $address->val->cityErr; ?></span>
                            <?php endif; ?>

                        </div>
                        <div class="col-xl-6 form-group">
                            <label for="">Irányítószám: <span class="text-danger">*</span></label>
                            <input type="text"
                                   value="<?php echo $address->getZipcode() ?>"
                                   name="zipcode"
                                   class="form-control"
                                   id=""
                                   placeholder="6726">

                            <?php if (!empty($address->val->zipcodeErr)): ?>
                                <span class="error"><?php echo $address->val->zipcodeErr; ?></span>
                            <?php endif; ?>

                        </div>
                        <div class="col-xl-6 form-group">
                            <label for="">Utca: <span class="text-danger">*</span></label>
                            <input type="text"
                                   value="<?php echo $address->getStreet() ?>"
                                   name="street"
                                   class="form-control"
                                   id=""
                                   placeholder="Példa utca 11">

                            <?php if (!empty($address->val->streetErr)): ?>
                                <span class="error"><?php echo $address->val->streetErr; ?></span>
                            <?php endif; ?>

                        </div>
                    </div>

                    <?php if (isset($_GET['type']) && $_GET['type'] === 'shipping'): ?>


                        <div class="col-xl-12 form-group">
                            <input class="form-check-input"
                                   name="default"
                                   type="checkbox"
                                <?php $address->getDefault() == '1' ? print 'checked' : '' ?>
                                   value="0"
                                   id="flexCheckDefault">


                            <label class="form-check-label" for="flexCheckDefault">
                                Beállítás alapértelmezett címnek
                            </label>
                        </div>


                    <?php endif; ?>

                    <button type="submit" name="submit" class="btn btn-success btn-sm">Mentés</button>
                    <a href="address.php?user_id=<?php echo $user_id; ?>" class="btn btn-primary btn-sm">Vissza</a>

                </form>
            </div>
        </div>
    </div>

</div>

</div>


</body>
</html>