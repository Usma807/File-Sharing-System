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
    <title>Ulashilgan jildlar </title>
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
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Do'stlar bilan umumiy jild yaratish</h4>
                                    <p class="card-description">
                                        <?php
                                    if (isset($_SESSION['sf_created'])) {
                                        ?>
                                    <div id="notification" class="alert alert-success" role="alert">
                                        <b> <i class="bi bi-check-circle-fill"></i>Muvaffaqiyatli ! </b> Umumiy jild muvaffaqiyatli yaratildi.
                                    </div>
                                    <?php
                                       unset($_SESSION['sf_created']);
                                    }
                                    ?>
                                    </p>
                                    <form class="forms-sample" action="php/new_share_folder.php" method="POST">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Umumiy jild nomi</label>
                                            <input type="text" name="foldername" class="form-control"
                                                id="exampleInputEmail1" placeholder="Jild nomi">
                                        </div>
                                        <button type="submit" class="btn btn-primary me-2">Yaratish</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"> Jildlarni ulashish </h4>
                                    <p class="card-description">
                                        <?php
                                    if (isset($_SESSION['sfdelete'])) {
                                        ?>
                                    <div id="notification" class="alert alert-success" role="alert">
                                        <b> <i class="bi bi-check-circle-fill"></i>Muvaffaqiyatli ! </b> Umumiy jild muvaffaqiyatli oʻchirildi.
                                    </div>
                                    <?php
                                       unset($_SESSION['sfdelete']);
                                    }
                                    ?>
                                    </p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Profil</th>
                                                    <th>A'zolar</th>
                                                    <th>Yaratilgan</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $userid = $_SESSION['user_id'];
                                                $sfsql = "SELECT DISTINCT sf.*, COALESCE(sf_member_count, 0) AS total_members
                                                FROM sharefolder AS sf
                                                LEFT JOIN sharefolder_members AS sfm ON sfm.member_sf = sf.sf_id
                                                LEFT JOIN (
                                                    SELECT member_sf, COUNT(*) AS sf_member_count
                                                    FROM sharefolder_members
                                                    GROUP BY member_sf
                                                ) AS member_counts ON member_counts.member_sf = sf.sf_id
                                                WHERE sf.sf_user = $userid OR sfm.member_userid = $userid";
                                                $sf_result = $conn->query($sfsql);

                                                if ($sf_result->num_rows > 0) {
                                                while($sfrow = $sf_result->fetch_assoc()) {
                                                    ?>
                                                <tr>
                                                    <td>
                                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                            width="32" height="32" viewBox="0 0 48 48">
                                                            <linearGradient id="WQEfvoQAcpQgQgyjQQ4Hqa_dINnkNb1FBl4_gr1"
                                                                x1="24" x2="24" y1="6.708" y2="14.977"
                                                                gradientUnits="userSpaceOnUse">
                                                                <stop offset="0" stop-color="#eba600"></stop>
                                                                <stop offset="1" stop-color="#c28200"></stop>
                                                            </linearGradient>
                                                            <path fill="url(#WQEfvoQAcpQgQgyjQQ4Hqa_dINnkNb1FBl4_gr1)"
                                                                d="M24.414,10.414l-2.536-2.536C21.316,7.316,20.553,7,19.757,7L5,7C3.895,7,3,7.895,3,9l0,30	c0,1.105,0.895,2,2,2l38,0c1.105,0,2-0.895,2-2V13c0-1.105-0.895-2-2-2l-17.172,0C25.298,11,24.789,10.789,24.414,10.414z">
                                                            </path>
                                                            <linearGradient id="WQEfvoQAcpQgQgyjQQ4Hqb_dINnkNb1FBl4_gr2"
                                                                x1="24" x2="24" y1="10.854" y2="40.983"
                                                                gradientUnits="userSpaceOnUse">
                                                                <stop offset="0" stop-color="#ffd869"></stop>
                                                                <stop offset="1" stop-color="#fec52b"></stop>
                                                            </linearGradient>
                                                            <path fill="url(#WQEfvoQAcpQgQgyjQQ4Hqb_dINnkNb1FBl4_gr2)"
                                                                d="M21.586,14.414l3.268-3.268C24.947,11.053,25.074,11,25.207,11H43c1.105,0,2,0.895,2,2v26	c0,1.105-0.895,2-2,2H5c-1.105,0-2-0.895-2-2V15.5C3,15.224,3.224,15,3.5,15h16.672C20.702,15,21.211,14.789,21.586,14.414z">
                                                            </path>
                                                        </svg> &nbsp;
                                                        <?=$sfrow['sf_name']?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                    $members = $sfrow['total_members'];
                                                    if ($members == 1) {
                                                        echo $members. " azo";
                                                    }else {
                                                        echo $members. " azolar";
                                                    }

                                                    ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                                date_default_timezone_set('Asia/Kolkata');

                                                                $createdat = strtotime($sfrow['sf_date']);
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
                                                    <td><a href="share_folder_documents.php?id=<?=$sfrow['sf_id']?>"
                                                            class="btn btn-inverse-primary btn-sm rounded">Ochish</a>

                                                        <?php
                                                            $sf_id = $sfrow['sf_user'];
                                                            if ($sf_id == $userid) {
                                                                ?>
                                                        <button type="button"
                                                            class="btn btn-inverse-danger btn-sm rounded"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deletesharefolder<?=$sfrow['sf_id']?>">
                                                            O'chirish
                                                        </button>
                                                        <?php
                                                            }
                                                            ?>
                                                        <div class="modal fade"
                                                            id="deletesharefolder<?=$sfrow['sf_id']?>" tabindex="-1"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-body fs-6 fw-bold text-wrap">
                                                                    Haqiqatan ham bu umumiy jildni yopmoqchimisiz,
                                                                         barcha hujjatlar va a'zolar olib tashlanadi
                                                                         ushbu papkadan. Bunday harakat qaytarilishi mumkin emas. <br> Davom etishni xohlaysizmi?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary btn-sm"
                                                                            data-bs-dismiss="modal">Yopish</button>
                                                                        <a type="button"
                                                                            href="php/delete_sharefolder.php?sfid=<?=$sfrow['sf_id']?>"
                                                                            class="btn btn-danger btn-sm">Ha, Davom etish
                                                                            <i class="bi bi-arrow-right-short"></i></a>
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
                                                <td>Hech qanday ulashilgan jild topilmadi!</td>
                                                <?php
                                                }
                                                $conn->close();
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