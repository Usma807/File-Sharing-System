<?php
include '../config.php';
session_start();

$redirect = $_SERVER['HTTP_REFERER'];
$uid = $_GET['uid'];
$mid = $_GET['mid'];
$delete_docs = "DELETE FROM sharefolder_documents WHERE sfdoc_user= $uid";

if ($conn->query($delete_docs) === TRUE) {
        $sql = "DELETE FROM sharefolder_members  where member_id = $mid";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['memberremoved'] = "muvaffaqiyatli";
            header("location: $redirect");
        } else {
        echo "Xato: " . $conn->error;
        }
} else {
  echo "Xato: " . $conn->error;
}
?>