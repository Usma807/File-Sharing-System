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
    <title>Yangi hujjat yuklash</title>
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
                                    <h4 class="card-title">Yangi hujjat yuklash</h4>
                                    <p class="card-description">
                                        <?php
                                    if (isset($_SESSION['doc_upload'])) {
                                        ?>
                                    <div id="notification" class="alert alert-success" role="alert">
                                        <b> <i class="bi bi-check-circle-fill"></i>Muvaffaqiyatli ! </b>Hujjat muvaffaqiyatli yuklandi.
                                    </div>
                                    <?php
                                       unset($_SESSION['doc_upload']);
                                    }
                                    ?>
                                    <?php
                                    if (isset($_SESSION['file_size'])) {
                                        ?>
                                    <div id="notification" class="alert alert-danger" role="alert">
                                        <b> <i class="bi bi-x-circle-fill"></i></i>Muvaffaqiyatsiz ! </b> Fayl hajmi oshib ketdi
                                         ruxsat etilgan chegara (100 MB).
                                    </div>
                                    <?php
                                       unset($_SESSION['file_size']);
                                    }
                                    ?>
                                    <?php
                                    if (isset($_SESSION['file_exists'])) {
                                        ?>
                                    <div id="notification" class="alert alert-danger" role="alert">
                                        <b> <i class="bi bi-x-circle-fill"></i>Muvaffaqiyatsiz ! </b> Hujjat allaqachon mavjud.
                                    </div>
                                    <?php
                                       unset($_SESSION['file_exists']);
                                    }
                                    ?>
                                    </p>
                                    <form class="forms-sample" action="php/upload_new_document.php" method="POST"
                                        enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Hujjat nomi </label>
                                            <input type="text" name="name" class="form-control"
                                                id="exampleInputUsername1" placeholder="Hujjat nomi" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Jild </label>
                                            <select name="folder" class="form-control" id="" required>
                                                <option value="" selected hidden>Tanlash... </option>
                                                <?php
                                                $user = $_SESSION['user_id'];
                                                $sql = "SELECT * from folders where folder_user = $user";
                                                $result = $conn->query($sql);
                                                
                                                if ($result->num_rows > 0) {
                                                  while($row = $result->fetch_assoc()) {
                                                    ?>
                                                <option value="<?=$row['folder_id']?>">
                                                    <span class="text-capitalize"><?=$row['folder_name']?></span>
                                                </option>
                                                <?php
                                                  }
                                                }                                                 
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Hujjat tavsifi (ixtiyoriy)</label>
                                            <textarea id="inp_editor1" name="desc" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Hujjatni yuklash </label>
                                            <input type="file" name="file" class="form-control" id="" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary me-2">Yuborish</button>
                                        <button class="btn btn-secondary" type="reset">Tozalash</button>
                                    </form>
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
    var editor1 = new RichTextEditor("#inp_editor1");
    </script>

</body>

</html>