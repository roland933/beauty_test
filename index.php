<?php
require "config/Database.php";
require "model/User.php";
require "model/Log.php";
require "helper/Validation.php";
require "controller/UserController.php";
require "auth/Auth.php";

session_start();
$user = new UserController();
use Webapp\Auth\Auth as Auth;
$user_id = Auth::user_id();
if ($user_id) {
    $user->show($user_id);
    $user->update($user_id);
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
            <?php if ($user_id): ?>
            <div class="col-xl-12">
                <h3 class="mb-4 py-3 text-uppercase">Üdvözlünk <?php echo Auth::name(); ?></h3>
                <div class="message">
                    <?php echo $user->showMessage(); ?>
                    <?php unset($_SESSION['password_err']) ;  unset($_SESSION['warrning']); ?>
                </div>
                <h5 class="mb-4 text-uppercase">Személyes adatok </h5>
                <form method="post" action="">
                    <div class="row">
                        <div class="col-xl-12 form-group">
                            <label for="">Vezeték név:</label>
                            <input type="text"
                                   value="<?php echo $user->getFirstname(); ?>"
                                   class="form-control"
                                   required
                                   id=""
                                   name="fname"
                                   placeholder="Vezeték név">
                            <?php if (!empty($user->val->firstNameErr)): ?>
                                <span class="error"><?php echo $user->val->firstNameErr ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="col-xl-12 form-group">
                            <label for="">Kereszt név:</label>
                            <input type="text"
                                   value="<?php echo $user->getLastname() ?>"
                                   class="form-control"
                                   required
                                   id=""
                                   name="lname"
                                   placeholder="Kereszt név">
                            <?php if (!empty($user->val->lastNameErr)): ?>
                                <span class="error"><?php echo $user->val->lastNameErr ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Email cím</label>
                        <input type="email"
                               value="<?php echo $user->getEmail() ?>"
                               class="form-control"
                               id=""
                               name="email"
                               required
                               placeholder="example@hotmail.com">

                        <?php if (!empty($user->val->emailErr)): ?>
                            <span class="error"><?php echo $user->val->emailErr ?></span>
                        <?php endif; ?>

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Jelszó</label>
                        <input type="password"
                               name="password"
                               value=""
                               class="form-control"
                               id="exampleInputPassword1"
                               required
                               placeholder="*****">

                        <?php if (!empty($user->val->passwordErr)): ?>
                            <span class="error"><?php echo $user->val->passwordErr ?></span>
                        <?php endif; ?>

                    </div>

                    <input name="user_id" type="hidden" value="<?php echo $user->getId() ?>"/>
                    <button type="submit" name="update_user" class="btn btn-primary btn-sm">Mentés</button>


                </form>

            </div>
        </div>
    <?php else: ?>
        <div class="welcome text-center py-4">
            <h4 class="text-uppercase">Üdvözlünk Vendég!</h4>
            <p>Az oldal megtekintéséhez kérlek jelentkezz be!</p>
        </div>

    <?php endif; ?>
    </div>
</div>
</body>
</html>