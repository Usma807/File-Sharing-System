<?php
include '../config.php';
session_start();

$redirect = $_SERVER['HTTP_REFERER'];

$sharefolder = $_POST['sharefolder'];
$member = $_POST['member'];

$verify_sql = "SELECT count(member_id) as verified from sharefolder_members where member_sf = $sharefolder AND member_userid = $member";
$verify_result = $conn->query($verify_sql);

if ($verify_result->num_rows > 0) {
  while($verify_row = $verify_result->fetch_assoc()) {
    $verified = $verify_row['verified'];
    if ($verified == 0 ) {
       $sql = "INSERT INTO sharefolder_members ( member_sf ,member_userid)
       VALUES ('$sharefolder', '$member')";

       if ($conn->query($sql) === TRUE) {
           $_SESSION['memberadded'] = "muvaffaqiyatli";
           header("location: $redirect");
       } else {
       echo "Xato: " . $sql . "<br>" . $conn->error;
       }
    }
    else{
        $_SESSION['memberexists'] = "muvaffaqiyatli";
           header("location: $redirect");
    }
  }
} else {
  echo "0 natija";
}

?>