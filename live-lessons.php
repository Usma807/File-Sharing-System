<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Jonli Darslar</title>
    <?php include 'partials/headtags.php'; ?>
</head>

<body>
    <div class="container-scroller">
        <?php include 'partials/navbar.php'; ?>
        <div class="container-fluid page-body-wrapper">
            <?php include 'partials/settings_panel.php'; ?>
            <?php include 'partials/sidebar.php'; ?>

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">


                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'partials/javascripts.php'; ?>

</body>

</html>