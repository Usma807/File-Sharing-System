<?php
include '../config.php';
session_start();

$user = $_SESSION['user_id'];
$redirect = $_SERVER['HTTP_REFERER'];
$pin = $_POST['pin'];
$folderid = $_POST['folderid'];

$sql = "SELECT * from users where user_id = $user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
   $hashed = $row['user_pin'];
if (password_verify($pin, $hashed)) {
    header("location: ../documents_lists_byfolder.php?fid=$folderid");
}
else {
    $_SESSION['wrongpin'] = "muvaffaqiyatli";
    header("location: $redirect");
}
  }
} else {
  echo "0 natija";
}

?>