<?php
include '../config.php';
session_start();

$redirect = $_SERVER['HTTP_REFERER'];

$userid = $_SESSION['user_id'];
$frdid = $_GET['frd_id'];

$sql = "SELECT * FROM friends where frd_id = $frdid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $friendid = $row['frd_friend'];

    $delete1 = "DELETE FROM friends where frd_user = $userid AND frd_friend = $friendid";
    if ($conn->query($delete1) === TRUE) {
        $delete2 = "DELETE FROM friends where frd_user = $friendid AND frd_friend = $userid";
        if ($conn->query($delete2) === TRUE) {
            $_SESSION['unfriend'] = "muvaffaqiyatli";
            header("location: $redirect");
        } else {
            echo "Xato: " . $conn->error;
        }
    } else {
        echo "Xato: " . $conn->error;
    }
  }
} else {
  echo "Do'st IDsi topilmadi!";
}
?>