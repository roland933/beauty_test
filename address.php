<?php

require "config/Database.php";
require "model/Address.php";
require "model/Log.php";
require "controller/AddressController.php";
require "auth/Auth.php";
session_start();
use Webapp\Auth\Auth as Auth;
$user_id = Auth::user_id();
$address = new AddressController();
$address->deleteAllShipping($user_id);
$address->deleteAllBillingAddress($user_id);
$address->deleteAddressById();
Auth::redirect();
?>

<!doctype html>
<html lang="en">
<?php require "inc/head.php"; ?>
<body>
<div class="page">
    <div class="container">
        <?php include('inc/navigation.php'); ?>
        <div class="content">
            <?php if(Auth::isAuth()): ?>
            <div class="col-xl-12">
                <div class="content-header mb-5 py-3 text-uppercase"><h3>Címek</h3></div>
                <div class="d-flex bd-highlight mb-3">
                    <div class="mr-auto "><h5>Szállítási címek </h5></div>
                    <div class="p-1"><a class="btn btn-success btn-sm"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Új szállítási cím"
                                        href="form.php?action=add&&type=shipping&&user_id=<?php echo $user_id; ?>">
                            <i class="fas fa-plus"></i></a>

                    </div>
                    <?php if ($address->fetchAllShippingAddress()): ?>
                        <div class="p-1 bd-highlight">
                            <form method="post" action="">
                                <button type="submit"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Szállítási címek törlése"
                                        class="btn btn-danger btn-sm"
                                        name="delete">
                                    <i class="fas fa-trash"></i></button>
                            </form>

                        </div>
                    <?php endif; ?>
                </div>

                <?php if ($address->fetchAllShippingAddress()): ?>
                    <table class="table table-sm table-bordered">
                        <thead class="bg-light">
                        <th>#</th>
                        <th>Név</th>
                        <th>Város</th>
                        <th>Irányítószám</th>
                        <th>Utca</th>
                        <th>Alapértelmezett</th>
                        <th></th>
                        </thead>

                        <?php foreach ($address->fetchAllShippingAddress() as $row): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['city']; ?></td>
                                <td><?php echo $row['zipcode']; ?></td>
                                <td><?php echo $row['street']; ?></td>

                                <td><?php $row['set_default'] == '1' ? print 'igen' : print 'nem'; ?></td>

                                <td style="width:10%">
                                    <a class="btn btn-sm btn-modify"
                                       href="form.php?action=edit&&type=shipping&&address_id=<?php echo $row['id']; ?>&&user_id=<?php echo $user_id; ?>">
                                        <i class="fad fa-edit"></i></a>
                                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?user_id=<?php echo $user_id; ?>&&delete_id=<?php echo $row['id'] ?>&&type=shipping"
                                       class="btn btn-sm btn-delete"><i class="far fa-times"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </table>

                <?php else : ?>

                    <div class="alert alert-info">Jelenleg nincs szállítási cím megadva</div>

                <?php endif; ?>

                <!--- Számlázási címek --->
                <div class="billing-address mt-5">
                    <div class="d-flex bd-highlight mb-3">
                        <div class="mr-auto p-2 bd-highlight"><h5>Számlázási címek </h5></div>
                        <div class="p-1 bd-highlight"><a class="btn btn-success btn-sm"
                                                         data-toggle="tooltip"
                                                         data-placement="top"
                                                         title="Új számlázási cím"
                                                         href="form.php?action=add&&type=billing&&user_id=<?php echo $user_id; ?>">
                                <i class="fas fa-plus"></i></a>

                        </div>
                        <?php if ($address->fetchAllBillingAddress()): ?>
                            <div class="p-1 bd-highlight">
                                <form method="post" action="">
                                    <button type="submit"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Számlázási címek törlése"
                                            class="btn btn-danger btn-sm"
                                            name="delete_all_ba"><i
                                                class="fas fa-trash"></i></button>
                                </form>

                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if ($address->fetchAllBillingAddress()): ?>

                        <table class="table table-sm table-bordered">
                            <thead class="bg-light">
                            <th>#</th>
                            <th>Név</th>
                            <th>Adószám</th>
                            <th>Megye</th>
                            <th>Város</th>
                            <th>Utca</th>
                            <th>Irányítószám</th>
                            <th></th>
                            </thead>

                            <?php foreach ($address->fetchAllBillingAddress() as $row): ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['tax_number']; ?></td>
                                    <td><?php echo $row['region']; ?></td>
                                    <td><?php echo $row['city']; ?></td>
                                    <td><?php echo $row['street']; ?></td>
                                    <td><?php echo $row['zipcode']; ?></td>
                                    <td style="width:10%">
                                        <a class="btn btn-sm btn-modify"
                                           href="form.php?action=edit&&type=billing&&address_id=<?php echo $row['id']; ?>&&user_id=<?php echo $user_id; ?>">
                                            <i class="fad fa-edit"></i></a>
                                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>?user_id=<?php echo $user_id; ?>&&delete_id=<?php echo $row['id'] ?>&&type=billing"
                                           class="btn btn-sm btn-delete"><i class="far fa-times"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </table>
                    <?php else : ?>

                        <div class="alert alert-info">Jelenleg nincs számlázási cím megadva</div>

                    <?php endif; ?>

                </div>
            </div>
        </div>
    <?php endif;?>
    </div>

</div>

</body>
</html>