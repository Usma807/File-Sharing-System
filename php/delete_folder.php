<?php
include '../config.php';
session_start();

$fid = $_GET['fid'];
$redirect = $_SERVER['HTTP_REFERER'];

$sql1 = "SELECT * from folders where folder_id = $fid";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
  while($row1 = $result1->fetch_assoc()) {
    $foldername = $row1['folder_name'];

    $folderNameToDelete = $foldername;

    $directory = "../folders_list/"; 

    if (file_exists($directory . $folderNameToDelete)) {
        if (rmdir($directory . $folderNameToDelete)) {

            $sql = "DELETE FROM folders WHERE folder_id = $fid";

            if ($conn->query($sql) === TRUE) {
                $_SESSION['folder_deleted'] = "muvaffaqiyatli";
                header("location: $redirect");
            } else {
                echo "Xato: " . $conn->error;
            }

            $conn->close();
        } else {
            $_SESSION['error_delete_folder'] = "muvaffaqiyatli";
            header("location: $redirect");
        }
    } else {
        echo "Jild topilmadi.";
    }
  }
} else {
  echo "Bazadan jildni topishda xatolik ";
}

?>