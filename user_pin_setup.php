<?php
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
include 'config.php';
include 'partials/php_functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title> Foydalanuvchi PIN-kodini sozlash </title>
    <?php include 'partials/headtags.php'; ?>
</head>

<body>
    <div class="container-scroller">
        <?php include 'partials/navbar.php'; ?>
        <div class="container-fluid page-body-wrapper">
            <?php include 'partials/settings_panel.php'; ?>
            <?php include 'partials/sidebar.php'; ?>

            <?php
            if ($_SESSION['role'] == 0) {
                ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Foydalanuvchi PIN kodini o'zgartirish</h4>
                                    <p class="card-description">
                                        <?php
                                    if (isset($_SESSION['pinchanged'])) {
                                        ?>
                                    <div id="notification" class="alert alert-success" role="alert">
                                        <b> <i class="bi bi-exclamation-triangle-fill"></i>Muvaffaqiyatli ! </b> PIN kod muvaffaqiyatli almashtirildi.
                                    </div>
                                    <?php
                                       unset($_SESSION['pinchanged']);
                                    }
                                    ?>
                                    <?php
                                    if (isset($_SESSION['wrongpwd'])) {
                                        ?>
                                    <div id="notification" class="alert alert-danger" role="alert">
                                        <b> <i class="bi bi-exclamation-triangle-fill"></i>Muvaffaqiyatsiz ! </b> Xato Parol.
                                    </div>
                                    <?php
                                       unset($_SESSION['wrongpwd']);
                                    }
                                    ?>
                                    </p>
                                    <form class="forms-sample" action="php/update_user_pin.php" method="POST">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Yangi PIN</label>
                                            <input type="text" maxlength="4" name="pin" class="form-control"
                                                id="exampleInputUsername1" placeholder="PIN kiriting">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Parol</label>
                                            <input type="password" name="password" class="form-control"
                                                id="exampleInputEmail1" placeholder="Parol kiriting">
                                        </div>

                                        <button type="submit" class="btn btn-primary me-2">PIN kodni o'zgartirish</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>

        </div>
    </div>
    <?php include 'partials/javascripts.php'; ?>
</body>

</html>