<?php
require "config/Database.php";
require "model/Registration.php";
require "helper/Validation.php";
require "model/User.php";
session_start();
$reg = new Registration();
$reg->action();

?>

<!doctype html>
<html lang="en">
<?php require "inc/head.php"; ?>
<body>
<div class="page">
    <div class="container">
        <?php include('inc/navigation.php'); ?>
        <div class="content">
            <div class="row justify-content-center">

                <div class="col-xl-8 col-lg-10 col-md-11">
                    <div class="page-header mb-5 text-center text-uppercase mt-3"><h3>Regisztráció</h3></div>

                    <form method="post" action="" class="mb-3" autocomplete="off">

                        <div class="row form-group">
                            <label class="col-sm-2 col-form-label">Vezeték név:</label>
                            <div class="col-sm-10">

                                <input type="text"
                                       value="<?php isset($_POST['reg']) ? print $reg->user->getFirstName() : '' ?>"
                                       name="firstname"
                                       class="form-control"
                                       required
                                       placeholder="Vezeték név"/>

                                <?php if (!empty($reg->val->firstNameErr)): ?>
                                    <span class="error"><?php echo $reg->val->firstNameErr ?></span>
                                <?php endif; ?>
                            </div>

                        </div>

                        <div class="row form-group">
                            <label class="col-sm-2 col-form-label">Kereszt név:</label>
                            <div class="col-sm-10">

                                <input type="text"
                                       value="<?php isset($_POST['reg']) ? print $reg->user->getLastName() : '' ?>"
                                       name="lastname"
                                       class="form-control"
                                       required
                                       placeholder="Kereszt név"/>
                                <?php if (!empty($reg->val->lastNameErr)): ?>
                                    <span class="error"><?php echo $reg->val->lastNameErr ?></span>
                                <?php endif; ?>
                            </div>

                        </div>

                        <div class="row form-group">
                            <label class="col-sm-2 col-form-label">Email cím:</label>
                            <div class="col-sm-10">

                                <input type="email"
                                       value="<?php isset($_POST['reg']) ? print $reg->user->getEmail() : '' ?>"
                                       name="email"
                                       class="form-control"
                                       required
                                       placeholder="example@gmail.com"/>

                                <?php if (!empty($reg->val->emailErr)): ?>
                                    <span class="error"><?php echo $reg->val->emailErr ?></span>
                                <?php endif; ?>


                            </div>


                        </div>

                        <div class="row form-group">
                            <label class="col-sm-2 col-form-label">Jelszó:</label>
                            <div class="col-sm-10 mb-3">
                                <input type="password"
                                       value="<?php isset($_POST['reg']) ? print $reg->user->getPassword() : '' ?>"
                                       name="password"
                                       class="form-control"
                                       required
                                       placeholder="Jelszó">

                                <?php if (!empty($reg->val->passwordErr)): ?>
                                    <span class="error"><?php echo $reg->val->passwordErr ?></span>
                                <?php endif; ?>
                            </div>


                        </div>

                        <div class="row form-group">
                            <label class="col-sm-2 col-form-label">Jelszó újra:</label>
                            <div class="col-sm-10 mb-3">
                                <input type="password"
                                       value=""
                                       name="repass"
                                       class="form-control"
                                       placeholder="Jelszó  újra">

                                <?php if (!empty($reg->val->rePassErr)): ?>
                                    <span class="error"><?php echo $reg->val->rePassErr ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <small id="emailHelp" class="form-text text-muted mb-4">
                            <i class="fad fa-info-circle"></i> A jelszó nem lehet 4 karakternél rövidebb!</small>
                        <div class="text-center">
                            <button type="submit"
                                    class="btn btn-default btn-blue btn-sm"
                                    name="reg">
                                Regisztrácó
                            </button>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>