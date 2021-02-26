<?php
require "config/Database.php";
require "model/Login.php";
require "helper/Validation.php";
require "model/User.php";
session_start();
$login = new Login();
$login->action();

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

                <div class="col-xl-8 col-lg-8 col-md-8 col-8">
                    <div class="page-header mb-5 text-center text-uppercase mt-3"><h3>Bejelentkezés </h3></div>
                    <?php if(isset($_SESSION['error'])) : ?>
                            <p class="text-danger text-center"><?php echo $_SESSION['error'];?></p>
                    <?php endif; ?>
                    <?php  unset($_SESSION['error']) ?>
                    <form method="post" action="" class="mb-3" autocomplete="off">
                        <div class="row form-group">
                            <label class="col-sm-2 col-form-label">Email cím:</label>
                            <div class="col-sm-10">
                                <input type="email"
                                       value="<?php isset($_POST['login']) ? print $_POST['email'] : ''?>"
                                       name="email"
                                       class="form-control"
                                       id="email"
                                       required
                                       placeholder="email cím"/>

                                <?php if(!empty($reg->val->emailErr)): ?>
                                    <span class="error"><?php echo $reg->val->emailErr ?></span>
                                <?php endif; ?>


                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-sm-2 col-form-label">Jelszó:</label>
                            <div class="col-sm-10 mb-3">
                                <input type="password"
                                       value="<?php isset($_POST['reg']) ? print $_POST['password'] : ''?>"
                                       name="password"
                                       class="form-control"
                                       id="password"
                                       required
                                       placeholder="Jelszó">

                                <?php if(!empty($reg->val->passwordErr)): ?>
                                    <span class="error"><?php echo $reg->val->passwordErr ?></span>
                                <?php endif; ?>
                            </div>


                        </div>


                        <div class="text-center">
                        <button type="submit"
                                class="btn btn-default btn-blue btn-sm"
                                name="login">
                           Bejelentkezés
                        </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>