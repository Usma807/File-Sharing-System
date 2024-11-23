<?php
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
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
    <title>Yangi jild yaratish</title>
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
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Yangi jild yaratish </h4>
                                    <p class="card-description">
                                        <?php
                                    if (isset($_SESSION['new_folder_created'])) {
                                        ?>
                                    <div id="notification" class="alert alert-success" role="alert">
                                        <b> <i class="bi bi-check-circle-fill"></i>Muvaffaqiyatli ! </b>Yangi jild yaratildi
                                         muvaffaqiyatli.
                                    </div>
                                    <?php
                                       unset($_SESSION['new_folder_created']);
                                    }
                                    ?>
                                    <?php
                                    if (isset($_SESSION['folder_exists'])) {
                                        ?>
                                    <div id="notification" class="alert alert-danger" role="alert">
                                        <b> <i class="bi bi-x-circle-fill"></i>Muvaffaqiyatsiz ! </b> Jild nomi mavjud emas.
                                         Iltimos, boshqa nom tanlang.
                                    </div>
                                    <?php
                                       unset($_SESSION['folder_exists']);
                                    }
                                    ?>
                                    </p>
                                    <form class="forms-sample" action="php/new_folder.php" method="post">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Jild nomi </label>
                                            <input type="text" name="folder" class="form-control"
                                                id="exampleInputUsername1" placeholder="Hujjat nomi" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary me-2">Jild yaratish</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Jildlar ro'yxati</h4>
                                    <p class="card-description fs-5">
                                        <?php
                                    if (isset($_SESSION['folder_deleted'])) {
                                        ?>
                                    <div id="notification" class="alert alert-danger" role="alert">
                                        <b> <i class="bi bi-check-circle-fill"></i> O'chirilgan ! </b>Jild muvaffaqiyatli oʻchirildi.
                                    </div>
                                    <?php
                                       unset($_SESSION['folder_deleted']);
                                    }
                                    ?>
                                    <?php
                                    if (isset($_SESSION['locked'])) {
                                        ?>
                                    <div id="notification" class="alert alert-success" role="alert">
                                        <b> <i class="bi bi-check-circle-fill"></i> Muvaffaqiyatli ! </b>Jild maxfiyligi muvaffaqiyatli yangilandi.
                                    </div>
                                    <?php
                                       unset($_SESSION['locked']);
                                    }
                                    ?>
                                    <?php
                                    if (isset($_SESSION['pin_notmatch'])) {
                                        ?>
                                    <div id="notification" class="alert alert-danger" role="alert">
                                        <b> <i class="bi bi-exclamation-triangle-fill"></i>Muvaffaqiyatsiz ! </b> Xato PIN.
                                    </div>
                                    <?php
                                       unset($_SESSION['pin_notmatch']);
                                    }
                                    ?>
                                     <?php
                                    if (isset($_SESSION['error_delete_folder'])) {
                                        ?>
                                    <div id="notification" class="alert alert-danger" role="alert">
                                        <b> <i class="bi bi-exclamation-triangle-fill"></i>Muvaffaqiyatsiz ! </b> Oʻchirish uchun jild boʻsh boʻlishi kerak.
                                    </div>
                                    <?php
                                       unset($_SESSION['error_delete_folder']);
                                    }
                                    ?>
                                    </p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Nomi </th>
                                                    <th>Yatatilgan</th>
                                                    <th>Maxfiylik</th>
                                                    <th>O'chirish</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                        $user = $_SESSION['user_id'];
                                                        $sql = "SELECT * from folders where folder_user = $user";
                                                        $result = $conn->query($sql);

                                                        if ($result->num_rows > 0) {
                                                        while($row = $result->fetch_assoc()) {
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
                                                        </svg>
                                                        <span class="text-capitalize"><?=$row['folder_name']?></span>
                                                    </td>
                                                    <td><?=date('d M Y', strtotime($row['folder_date']))?></td>
                                                    <td>
                                                        <?php
                                                    $lock = $row['folder_lock'];
                                                    if ($lock == 1) {
                                                        ?>
                                                        <button type="button"
                                                            class="btn btn-inverse-success btn-icon rounded-pill btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#locked<?=$row['folder_id']?>">
                                                            <i class="bi bi-lock-fill"></i> Qulflangan
                                                        </button>


                                                        <?php
                                                    }else{
                                                        ?>
                                                        <button type="button"
                                                            class="btn btn-inverse-danger btn-icon rounded-pill btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#locked<?=$row['folder_id']?>">
                                                            <i class="bi bi-unlock-fill"></i> Ochiq
                                                        </button>
                                                        <?php
                                                    }
                                                    ?>
                                                        <div class="modal fade" id="locked<?=$row['folder_id']?>"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog ">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <form action="php/verify_pin.php" method="POST">
                                                                            <label for="exampleInputEmail1"
                                                                                class="form-label">PIN kiriting</label>
                                                                            <input type="text" name="pin" maxlength="4"
                                                                                class="form-control"
                                                                                id="exampleInputEmail1"
                                                                                aria-describedby="emailHelp">
                                                                            <input type="hidden" name="folderid"
                                                                                value="<?=$row['folder_id']?>">
                                                                            <div class="modal-footer">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">
                                                                                    <?php
                                                                                if ($lock == 1) {
                                                                                    echo "Ochish";
                                                                                }else {
                                                                                    echo "Qulflash";
                                                                                }

                                                                                ?>
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#delete<?=$row['folder_id']?>">
                                                            O'chirish
                                                        </button>

                                                        <div class="modal fade" id="delete<?=$row['folder_id']?>"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-body fs-6 text-wrap">
                                                                    Haqiqatan ham oʻchirib tashlamoqchimisiz
                                                                        <b
                                                                            class="text-capitalize">"<?=$row['folder_name']?>"</b>
                                                                        jild ?
                                                                        Bu amalni bekor qila olmaysiz.
                                                                    </div>
                                                                    <div class="modal-header d-flex flex-nowrap">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Rad etish</button>
                                                                        <a href="php/delete_folder.php?fid=<?=$row['folder_id']?>"
                                                                            class="btn btn-danger">O'chirish</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                                        }
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
    <script>
    var editor1 = new RichTextEditor("#inp_editor1");
    </script>



</body>

</html>