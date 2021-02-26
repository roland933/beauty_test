<?php

require_once "config/Database.php";
require_once "auth/Auth.php";
require "model/Log.php";
session_start();
use Webapp\Auth\Auth as Auth;
use Webapp\Model\Log as Log;

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
            <div class="col-xl-12">
                <h3 class="mb-5 py-3 text-uppercase">Előzmények</h3>

                <?php if (Log::getLog()): ?>
                <div class="history-table">
                    <table class="table table-bordered">

                        <tbody>
                        <?php foreach (Log::getLog() as $log) : ?>
                            <tr>
                                <td> <?php echo $log['action']; ?></td>
                                <td> <?php echo $log['date']; ?></td>


                            </tr>
                        <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</body>
</html>
