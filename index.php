<?php
require "config/Database.php";
require "model/User.php";
require "model/Log.php";
require "helper/Validation.php";
require "controller/UserController.php";
session_start();
$user = new UserController();
$user->show();
$user_id = $user->getId();
$user->update();

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
                <h3 class="mb-5 py-3 text-uppercase">Üdvözlünk <?php echo $user->fullName(); ?></h3>
                <h5 class="mb-4 text-uppercase">Személyes adatok </h5>
                <?php if(isset($_SESSION['message'])): ?>
                    <div class="alert alert-success">
                        <?php echo $_SESSION['message']; ?>
                    </div>

                <?php endif; ?>

                <form method="post" action="">
                    <div class="row">
                        <div class="col-xl-12 form-group">
                            <label for="">Vezeték név:</label>
                            <input type="text"
                                   value="<?php echo $user->getFirstname(); ?>"
                                   class="form-control"
                                   id=""
                                   name="fname"
                                   placeholder="Vezeték név">

                        </div>

                        <div class="col-xl-12 form-group">
                            <label for="">Kereszt név:</label>
                            <input type="text"
                                   value="<?php echo $user->getLastname() ?>"
                                   class="form-control"
                                   id=""
                                   name="lname"
                                   placeholder="Kereszt név">

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

                        <?php if(!empty($user->val->emailErr)): ?>
                            <span class="error"><?php echo $user->val->emailErr ?></span>
                        <?php endif; ?>

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Jelszó</label>
                        <input type="password"
                               name="password"
                               value="<?php echo $user->getPassword() ?>"
                               class="form-control"
                               id="exampleInputPassword1"
                               placeholder="jelszó">
                    </div>

                    <input name="user_id" type="hidden" value="<?php echo $user->getId() ?>" />
                    <button type="submit" name="update_user" class="btn btn-primary btn-sm">Mentés</button>


                </form>

            </div>
        </div>
    </div>
</div>
<script>

    setTimeout(function() {
        let alert = document.querySelector(".alert");
        alert.remove();
    }, 3000);

</script>

</body>
</html>