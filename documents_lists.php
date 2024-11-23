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
    <title> Jildlar ro'yxati</title>
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
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                            width="32" height="32" viewBox="0 0 48 48">
                                            <linearGradient id="WQEfvoQAcpQgQgyjQQ4Hqa_dINnkNb1FBl4_gr1" x1="24" x2="24"
                                                y1="6.708" y2="14.977" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#eba600"></stop>
                                                <stop offset="1" stop-color="#c28200"></stop>
                                            </linearGradient>
                                            <path fill="url(#WQEfvoQAcpQgQgyjQQ4Hqa_dINnkNb1FBl4_gr1)"
                                                d="M24.414,10.414l-2.536-2.536C21.316,7.316,20.553,7,19.757,7L5,7C3.895,7,3,7.895,3,9l0,30	c0,1.105,0.895,2,2,2l38,0c1.105,0,2-0.895,2-2V13c0-1.105-0.895-2-2-2l-17.172,0C25.298,11,24.789,10.789,24.414,10.414z">
                                            </path>
                                            <linearGradient id="WQEfvoQAcpQgQgyjQQ4Hqb_dINnkNb1FBl4_gr2" x1="24" x2="24"
                                                y1="10.854" y2="40.983" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#ffd869"></stop>
                                                <stop offset="1" stop-color="#fec52b"></stop>
                                            </linearGradient>
                                            <path fill="url(#WQEfvoQAcpQgQgyjQQ4Hqb_dINnkNb1FBl4_gr2)"
                                                d="M21.586,14.414l3.268-3.268C24.947,11.053,25.074,11,25.207,11H43c1.105,0,2,0.895,2,2v26	c0,1.105-0.895,2-2,2H5c-1.105,0-2-0.895-2-2V15.5C3,15.224,3.224,15,3.5,15h16.672C20.702,15,21.211,14.789,21.586,14.414z">
                                            </path>
                                        </svg> Jildlar ro'yxati
                                        <a href="new_document.php"
                                            class="btn btn-inverse-success float-end rounded-pill btn-md">Yangi yuklash</a>
                                    </h4>
                                    <p class="card-description">
                                        <?php
                                    if (isset($_SESSION['wrongpin'])) {
                                        ?>
                                    <div id="notification" class="alert alert-danger" role="alert">
                                        <b> <i class="bi bi-exclamation-triangle-fill"></i>Muvaffaqiyatsiz ! </b> Xato PIN.
                                    </div>
                                    <?php
                                       unset($_SESSION['wrongpin']);
                                    }
                                    ?>
                                    </p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Jild </th>
                                                    <th>Elementlar</th>
                                                    <th>Hajm</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $user = $_SESSION['user_id'];                                            
                                                $sql = "SELECT folders.folder_id, folders.folder_name, folders.folder_lock,
                                                COUNT(documents.doc_id) AS item_count,
                                                SUM(documents.doc_size) AS folder_data_size
                                         FROM folders
                                         LEFT JOIN documents ON folders.folder_id = documents.doc_folder
                                         WHERE folders.folder_user = $user
                                         GROUP BY folders.folder_id, folders.folder_name";
                                                $result = $conn->query($sql);
                                                
                                                if ($result->num_rows > 0) {
                                                  while($row = $result->fetch_assoc()) {
                                                    ?>
                                                <tr>
                                                    <td>
                                                        <?php
                                                        $lock = $row['folder_lock'];
                                                        if ($lock == 1) {
                                                            ?>
                                                        <a href="#" class="text-decoration-none text-dark"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#verify_pin<?=$row['folder_id']?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                                width="32" height="32" viewBox="0 0 48 48">
                                                                <linearGradient
                                                                    id="WQEfvoQAcpQgQgyjQQ4Hqa_dINnkNb1FBl4_gr1" x1="24"
                                                                    x2="24" y1="6.708" y2="14.977"
                                                                    gradientUnits="userSpaceOnUse">
                                                                    <stop offset="0" stop-color="#eba600"></stop>
                                                                    <stop offset="1" stop-color="#c28200"></stop>
                                                                </linearGradient>
                                                                <path
                                                                    fill="url(#WQEfvoQAcpQgQgyjQQ4Hqa_dINnkNb1FBl4_gr1)"
                                                                    d="M24.414,10.414l-2.536-2.536C21.316,7.316,20.553,7,19.757,7L5,7C3.895,7,3,7.895,3,9l0,30	c0,1.105,0.895,2,2,2l38,0c1.105,0,2-0.895,2-2V13c0-1.105-0.895-2-2-2l-17.172,0C25.298,11,24.789,10.789,24.414,10.414z">
                                                                </path>
                                                                <linearGradient
                                                                    id="WQEfvoQAcpQgQgyjQQ4Hqb_dINnkNb1FBl4_gr2" x1="24"
                                                                    x2="24" y1="10.854" y2="40.983"
                                                                    gradientUnits="userSpaceOnUse">
                                                                    <stop offset="0" stop-color="#ffd869"></stop>
                                                                    <stop offset="1" stop-color="#fec52b"></stop>
                                                                </linearGradient>
                                                                <path
                                                                    fill="url(#WQEfvoQAcpQgQgyjQQ4Hqb_dINnkNb1FBl4_gr2)"
                                                                    d="M21.586,14.414l3.268-3.268C24.947,11.053,25.074,11,25.207,11H43c1.105,0,2,0.895,2,2v26	c0,1.105-0.895,2-2,2H5c-1.105,0-2-0.895-2-2V15.5C3,15.224,3.224,15,3.5,15h16.672C20.702,15,21.211,14.789,21.586,14.414z">
                                                                </path>
                                                            </svg>
                                                            <?=$row['folder_name']?> &nbsp;
                                                            <i class="bi bi-lock-fill fs-5"></i>
                                                        </a>

                                                        <div class="modal fade" id="verify_pin<?=$row['folder_id']?>"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <h5 class="align-items-center d-flex">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                x="0px" y="0px" width="32" height="32"
                                                                                viewBox="0 0 48 48">
                                                                                <linearGradient
                                                                                    id="WQEfvoQAcpQgQgyjQQ4Hqa_dINnkNb1FBl4_gr1"
                                                                                    x1="24" x2="24" y1="6.708"
                                                                                    y2="14.977"
                                                                                    gradientUnits="userSpaceOnUse">
                                                                                    <stop offset="0"
                                                                                        stop-color="#eba600"></stop>
                                                                                    <stop offset="1"
                                                                                        stop-color="#c28200"></stop>
                                                                                </linearGradient>
                                                                                <path
                                                                                    fill="url(#WQEfvoQAcpQgQgyjQQ4Hqa_dINnkNb1FBl4_gr1)"
                                                                                    d="M24.414,10.414l-2.536-2.536C21.316,7.316,20.553,7,19.757,7L5,7C3.895,7,3,7.895,3,9l0,30	c0,1.105,0.895,2,2,2l38,0c1.105,0,2-0.895,2-2V13c0-1.105-0.895-2-2-2l-17.172,0C25.298,11,24.789,10.789,24.414,10.414z">
                                                                                </path>
                                                                                <linearGradient
                                                                                    id="WQEfvoQAcpQgQgyjQQ4Hqb_dINnkNb1FBl4_gr2"
                                                                                    x1="24" x2="24" y1="10.854"
                                                                                    y2="40.983"
                                                                                    gradientUnits="userSpaceOnUse">
                                                                                    <stop offset="0"
                                                                                        stop-color="#ffd869"></stop>
                                                                                    <stop offset="1"
                                                                                        stop-color="#fec52b"></stop>
                                                                                </linearGradient>
                                                                                <path
                                                                                    fill="url(#WQEfvoQAcpQgQgyjQQ4Hqb_dINnkNb1FBl4_gr2)"
                                                                                    d="M21.586,14.414l3.268-3.268C24.947,11.053,25.074,11,25.207,11H43c1.105,0,2,0.895,2,2v26	c0,1.105-0.895,2-2,2H5c-1.105,0-2-0.895-2-2V15.5C3,15.224,3.224,15,3.5,15h16.672C20.702,15,21.211,14.789,21.586,14.414z">
                                                                                </path>
                                                                            </svg>
                                                                            Jild qulflangan &nbsp; <i
                                                                                class="bi bi-lock-fill"></i>
                                                                        </h5> <br>
                                                                        <form action="php/verify_pin_to_open_folder.php"
                                                                            method="POST">
                                                                            <label for="exampleInputEmail1"
                                                                                class="form-label">PIN kiriting</label>
                                                                            <input type="number" name="pin" min="0"
                                                                                max="9999" class="form-control"
                                                                                id="pinInput">

                                                                            <input type="hidden" name="folderid"
                                                                                value="<?=$row['folder_id']?>">
                                                                            <div class="modal-footer mb-0">
                                                                                <button type="submit"
                                                                                    class="btn btn-inverse-primary rounded-pill">Davom etish
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>



                                                        <?php
                                                        }
                                                        else {
                                                            ?>
                                                        <a href="documents_lists_byfolder.php?fid=<?=$row['folder_id']?>"
                                                            class="text-decoration-none text-dark text-capitalize">
                                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                                width="32" height="32" viewBox="0 0 48 48">
                                                                <linearGradient
                                                                    id="WQEfvoQAcpQgQgyjQQ4Hqa_dINnkNb1FBl4_gr1" x1="24"
                                                                    x2="24" y1="6.708" y2="14.977"
                                                                    gradientUnits="userSpaceOnUse">
                                                                    <stop offset="0" stop-color="#eba600"></stop>
                                                                    <stop offset="1" stop-color="#c28200"></stop>
                                                                </linearGradient>
                                                                <path
                                                                    fill="url(#WQEfvoQAcpQgQgyjQQ4Hqa_dINnkNb1FBl4_gr1)"
                                                                    d="M24.414,10.414l-2.536-2.536C21.316,7.316,20.553,7,19.757,7L5,7C3.895,7,3,7.895,3,9l0,30	c0,1.105,0.895,2,2,2l38,0c1.105,0,2-0.895,2-2V13c0-1.105-0.895-2-2-2l-17.172,0C25.298,11,24.789,10.789,24.414,10.414z">
                                                                </path>
                                                                <linearGradient
                                                                    id="WQEfvoQAcpQgQgyjQQ4Hqb_dINnkNb1FBl4_gr2" x1="24"
                                                                    x2="24" y1="10.854" y2="40.983"
                                                                    gradientUnits="userSpaceOnUse">
                                                                    <stop offset="0" stop-color="#ffd869"></stop>
                                                                    <stop offset="1" stop-color="#fec52b"></stop>
                                                                </linearGradient>
                                                                <path
                                                                    fill="url(#WQEfvoQAcpQgQgyjQQ4Hqb_dINnkNb1FBl4_gr2)"
                                                                    d="M21.586,14.414l3.268-3.268C24.947,11.053,25.074,11,25.207,11H43c1.105,0,2,0.895,2,2v26	c0,1.105-0.895,2-2,2H5c-1.105,0-2-0.895-2-2V15.5C3,15.224,3.224,15,3.5,15h16.672C20.702,15,21.211,14.789,21.586,14.414z">
                                                                </path>
                                                            </svg>
                                                            <?=$row['folder_name']?>
                                                        </a>
                                                        <?php
                                                        }
                                                        ?>

                                                    </td>
                                                    <td><?=$row['item_count']?> Elementlar </td>
                                                    <td>
                                                        <?php                                                         
                                                        $folderDataSize = $row['folder_data_size'];
                                                        $fileSizeFormatted = formatFileSize($folderDataSize);
                                                        echo $fileSizeFormatted;
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                  }
                                                } else {
                                                    ?>
<td>Hech qanday hujjat yuklanmagan</td>
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
    <script>
    $(document).ready(function() {
        $('#pinInput').on('input', function() {
            var inputValue = $(this).val();

            if (inputValue.length > 4) {
                $(this).val(inputValue.slice(0, 4));
            }
        });
    });
    </script>
</body>

</html>