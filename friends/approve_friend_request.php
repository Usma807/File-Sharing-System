<?php
include '../config.php';
session_start();

$redirect = $_SERVER['HTTP_REFERER'];
$fid = $_GET['fid'];

$finduser = "SELECT * FROM friend_requests where fr_id= $fid";
$findresult = $conn->query($finduser);

if ($findresult->num_rows > 0) {
  while($find = $findresult->fetch_assoc()) {
    $to = $find['fr_to'];
    $from = $find['fr_from'];
    $fromfriend = "INSERT INTO friends (frd_user, frd_friend) values ($from , $to);";
    $fromfriend .= "INSERT INTO friends (frd_user, frd_friend) values ($to, $from);";
    if ($conn->multi_query($fromfriend) === TRUE) {
        mysqli_next_result($conn); 

        $status = "DELETE FROM friend_requests WHERE fr_id=$fid";

        if ($conn->query($status) === TRUE) {
            $_SESSION['approve'] = "muvaffaqiyatli";
            header("location: $redirect");
        } else {
            echo "Xato: " . $conn->error;
        }
      } else {
        echo "Xato: " . $fromfriend . "<br>" . $conn->error;
      }
  }
} else {
  echo "0 natija";
}
?>