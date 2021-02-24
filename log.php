<?php

require_once "config/Database.php";
require "model/Log.php";

use Webapp\Model\Log as Log;

$user_id = $_GET['user_id'];
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
                <?php endif; ?>

            </div>
        </div>
    </div>
</body>
</html>
