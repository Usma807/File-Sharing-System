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
    <title>Do'stlar ro'yxati </title>
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
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Do'stlar ro'yxati </h4>
                                    <p class="card-description">
                                        <?php
                                    if (isset($_SESSION['unfriend'])) {
                                        ?>
                                    <div id="notification" class="alert alert-danger" role="alert">
                                        <b> <i class="bi bi-person-x-fill"></i> Olib tashlangan ! </b> Do'st muvaffaqiyatli olib tashlandi.
                                    </div>
                                    <?php
                                       unset($_SESSION['unfriend']);
                                    }
                                    ?>
                                    </p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Ism</th>
                                                    <th>Foydalanuvchi nomi</th>
                                                    <th>Yaratilgan</th>
                                                    <th>Olib tashlash</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $user = $_SESSION['user_id'];
                                                        $sql = "SELECT * FROM friends INNER JOIN users ON users.user_id = friends.frd_friend where frd_user = $user";
                                                        $result = $conn->query($sql);

                                                        if ($result->num_rows > 0) {
                                                        while($row = $result->fetch_assoc()) {
                                                            ?>
                                                <tr>
                                                    <td><span class="text-capitalize"><?=$row['user_fullname']?></span>
                                                    </td>
                                                    <td><?=$row['username']?></td>
                                                    <td>
                                                        <?php
                                                                date_default_timezone_set('Asia/Kolkata');

                                                                $createdat = strtotime($row['frd_date']);
                                                                $currentDate = time(); 

                                                                $timeDifference = $currentDate - $createdat;

                                                                $timePosted = '';

                                                                if ($timeDifference < 60) {
                                                                    $timePosted = "Hozirgina";
                                                                } elseif ($timeDifference < 3600) {
                                                                    $minutes = floor($timeDifference / 60);
                                                                    $timePosted = $minutes . ' minut' . ($minutes != 1 ? 's' : '') . ' oldin';
                                                                } elseif ($timeDifference < 86400) {
                                                                    $hours = floor($timeDifference / 3600);
                                                                    $timePosted = $hours . ' soat' . ($hours != 1 ? 's' : '') . ' oldin';
                                                                } elseif ($timeDifference < 2592000) {
                                                                    $days = floor($timeDifference / 86400);
                                                                    $timePosted = $days . ' kun' . ($days != 1 ? 's' : '') . ' oldin';
                                                                } else {
                                                                    $months = floor($timeDifference / 2592000); 
                                                                    $timePosted = $months . ' oy' . ($months != 1 ? 's' : '') . ' oldin';
                                                                }

                                                                echo $timePosted;
                                                                ?>
                                                    </td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-inverse-danger btn-sm rounded"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#frd_id<?=$row['frd_id']?>">
                                                            <i class="bi bi-person-dash-fill"></i> &nbsp; Olib tashlash
                                                        </button>

                                                        <div class="modal fade" id="frd_id<?=$row['frd_id']?>"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5 text-capitalize"
                                                                            id="exampleModalLabel">
                                                                            <?=$row['user_fullname']?></h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                    Haqiqatan ham doʻstlikni bekor qilmoqchimisiz <b
                                                                            class="text-capitalize"><?=$row['user_fullname']?></b>
                                                                        ?.
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Yopish</button>
                                                                        <a href="friends/unfriend_friend.php?frd_id=<?=$row['frd_id']?>"
                                                                            class="btn btn-danger rounded"> <i
                                                                                class="bi bi-person-dash-fill"></i>
                                                                            &nbsp; Olib tashlash</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                                        }
                                                        } else {
                                                            ?>
                                                <td>Hech qanday do'st yo'q </td>
                                                <?php
                                                        }
                                                ?>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php include 'partials/javascripts.php'; ?>


</body>

</html>