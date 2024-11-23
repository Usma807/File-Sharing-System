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
    <title>Yangi do'stlar qo'shing </title>
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
                                    <h4 class="card-title">Foydalanuvchilar</h4>
                                    <p class="card-description">
                                        <?php
                                    if (isset($_SESSION['requestsent'])) {
                                        ?>
                                    <div id="notification" class="alert alert-success" role="alert">
                                        <b> <i class="bi bi-person-check-fill"></i> Muvaffaqiyatli ! </b> Do'stlik so'rovi yuborildi
                                    </div>
                                    <?php
                                       unset($_SESSION['requestsent']);
                                    }
                                    ?>
                                    <?php
                                    if (isset($_SESSION['cancelrequest'])) {
                                        ?>
                                    <div id="notification" class="alert alert-danger" role="alert">
                                        <b> <i class="bi bi-person-x-fill"></i> Rad etilgan ! </b> Do'stlik so'rovi rad etildi.
                                    </div>
                                    <?php
                                       unset($_SESSION['cancelrequest']);
                                    }
                                    ?>
                                    </p>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Ism</th>
                                                    <th>Foydalanuvchi nomi</th>
                                                    <th>Qo'shilgan</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $user = $_SESSION['user_id'];
                                                $sql = "SELECT * 
                                                FROM users 
                                                WHERE user_id != $user 
                                                AND NOT EXISTS (
                                                    SELECT 1
                                                    FROM friends
                                                    WHERE (frd_user = $user AND frd_friend = users.user_id)
                                                    OR (frd_user = users.user_id AND frd_friend = $user)
                                                )";
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

                                                                $createdat = strtotime($row['created_at']);
                                                                $currentDate = time(); 

                                                                $timeDifference = $currentDate - $createdat;

                                                                $timePosted = '';

                                                                if ($timeDifference < 60) {
                                                                    $timePosted = "Hozirgina yuklangan";
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
                                                        <?php
                                                        $fr_sent = $row['user_id'];
                                                    $frsql = "SELECT count(friend_requests.fr_id) as sent, friend_requests.* from friend_requests where fr_to=$fr_sent AND fr_from = $user";
                                                    $fr_result = $conn->query($frsql);
                                                    
                                                    if ($fr_result->num_rows > 0) {
                                                      while($fr_row = $fr_result->fetch_assoc()) {                                                        
                                                        $sent = $fr_row['sent'];
                                                        if ($sent > 0 ) {
                                                            ?>
                                                        <a href="friends/cancel_friend_request.php?fid=<?=$fr_row['fr_id']?>"
                                                            class="btn btn-inverse-danger btn-sm rounded"><i
                                                                class="bi bi-person-x-fill"></i> &nbsp; Rad etish </a>
                                                        <?php
                                                        }else {
                                                            ?>
                                                        <a href="friends/send_friend_request.php?uid=<?=$row['user_id']?>"
                                                            class="btn btn-primary btn-sm rounded"><i
                                                                class="bi bi-person-plus-fill"></i> &nbsp; Qo'shish </a>
                                                        <?php
                                                        }
                                                        ?>

                                                        <?php
                                                      }
                                                    } else {
                                                     ?>

                                                        <?php
                                                    }

                                                    ?>

                                                    </td>
                                                </tr>
                                                <?php
                                                }
                                                } else {
                                                    ?>
                                                <td>Hech qanday foydalanuvchi topilmadi</td>

                                                <?php
                                                }
                                                ?>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"> Do'stlik so'rovlari </h4>
                                    <p class="card-description">
                                        <?php
                                    if (isset($_SESSION['approve'])) {
                                        ?>
                                    <div id="notification" class="alert alert-success" role="alert">
                                        <b> <i class="bi bi-person-fill-check"></i> Tasdiqlangan ! </b> Doʻstlik soʻrovi muvaffaqiyatli tasdiqlandi.
                                    </div>
                                    <?php
                                       unset($_SESSION['approve']);
                                    }
                                    ?>
                                    <?php
                                    if (isset($_SESSION['decline'])) {
                                        ?>
                                    <div id="notification" class="alert alert-danger" role="alert">
                                        <b> <i class="bi bi-person-x-fill"></i> Rad etildi ! </b> Do'stlik so'rovi
                                         muvaffaqiyatli rad etdi.
                                    </div>
                                    <?php
                                       unset($_SESSION['decline']);
                                    }
                                    ?>

                                    </p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Ism</th>
                                                    <th>Foydalanuvchi nomi</th>
                                                    <th> So'rov </th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                    $friendrequestssql = "SELECT * from friend_requests INNER JOIN users ON users.user_id = friend_requests.fr_from where fr_to = $user AND fr_status = 0";
                                                    $friendrequestsresult = $conn->query($friendrequestssql);

                                                    if ($friendrequestsresult->num_rows > 0) {
                                                    while($friendrequestsrow = $friendrequestsresult->fetch_assoc()) {
                                                        ?>
                                                <tr>
                                                    <td><span
                                                            class="text-capitalize"><?=$friendrequestsrow['user_fullname']?></span>
                                                    </td>
                                                    <td><?=$friendrequestsrow['username']?></td>
                                                    <td>
                                                        <?php
                                                                date_default_timezone_set('Asia/Kolkata');

                                                                $createdat = strtotime($friendrequestsrow['fr_date']);
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
                                                        <a href="friends/approve_friend_request.php?fid=<?=$friendrequestsrow['fr_id']?>"
                                                            class="btn btn-inverse-success btn-sm rounded">Tasdiqlash</a>
                                                        <a href="friends/decline_friend_request.php?fid=<?=$friendrequestsrow['fr_id']?>"
                                                            class="btn btn-inverse-danger btn-sm rounded">Rad etish</a>
                                                    </td>
                                                </tr>

                                                <?php
                                                    }
                                                    } else {
                                                        ?>
<td>Do'stlik so'rovlari yo'q</td>
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
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2024. Barcha huquqlar himoyalangan.</span>
                    </div>
                </footer>
            </div>

        </div>
    </div>
    <?php include 'partials/javascripts.php'; ?>
    <script>
    setTimeout(function() {
        var successAlert = document.getElementById('notification');
        successAlert.style.display = 'none';
    }, 3000);
    </script>

</body>

</html>