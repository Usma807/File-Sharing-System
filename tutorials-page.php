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
    <title>Darsliklar</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#open-ped").click(function(){
                $("#elektron-pedagogika").fadeToggle(500);
            });
            $("#web-dizayn").hide();
            $("#open-web").click(function(){
                $("#web-dizayn").fadeToggle(500);
            });
        })
    </script>
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
                    <div>
                    <button class="btn btn-primary container mb-3" id="open-ped">Elektron Pedagogika <span class="float-end fs-5">+</span></button>
                    </div>
                    <div class="row" id="elektron-pedagogika">
                    <?php
                    $arr = ["1-maruza","2-maruza","3-maruza","4-maruza","5-maruza","6-maruza","7-maruza","8-maruza","9-maruza","10-maruza","11-maruza","12-maruza"];
                    foreach($arr as $values){
                        echo "<div class='col-md-4'>
                            <div class='card shadow-lg p-3 mb-5 bg-body rounded'>
                                <div class='card-header'>
                                    Elektron Pedagogika
                                </div>
                                <div class='card-body'>
                                    <h5 class='card-title'>$values</h5>
                                    <p class='card-text'>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Amet, sunt!</p>
                                    <a href='lesson-resources/elektron-pedagogika/$values.docx' class='btn btn-primary rounded shadow-lg'><i class='icon-eye'></i></a>
                                    <a href='lesson-resources/elektron-pedagogika/$values.docx' class='btn btn-primary rounded shadow-lg' download><i class='icon-download'></i></a>
                                </div>
                            </div>
                        </div>";
                    }
                        ?>


                    </div>


                    <button class="btn btn-primary container mb-3" id="open-web">Web Dizayn <span class="float-end fs-5">+</span></button>
                    <div class="row" id="web-dizayn">
                    <?php
                    $arr = ["1-maruza","2-maruza","3-maruza","4-maruza","5-maruza","6-maruza","7-maruza","8-maruza","9-maruza","10-maruza","11-maruza","12-maruza"];
                    foreach($arr as $values){
                        echo "<div class='col-md-4'>
                            <div class='card shadow-lg p-3 mb-5 bg-body rounded'>
                                <div class='card-header'>
                                    Web Dizayn
                                </div>
                                <div class='card-body'>
                                    <h5 class='card-title'>$values</h5>
                                    <p class='card-text'>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Amet, sunt!</p>
                                    <a href='lesson-resources/web-dizayn/$values.docx' class='btn btn-primary rounded shadow-lg'><i class='icon-eye'></i></a>
                                    <a href='lesson-resources/web-dizayn/$values.docx' class='btn btn-primary rounded shadow-lg' download><i class='icon-download'></i></a>
                                </div>
                            </div>
                        </div>";
                    }
                        ?>


                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php include 'partials/javascripts.php'; ?>

</body>

</html>