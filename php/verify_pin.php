<?php
include '../config.php';
session_start();

$user = $_SESSION['user_id'];
$pin = $_POST['pin'];
$folderid = $_POST['folderid'];
$redirect = $_SERVER['HTTP_REFERER'];


$sql = "SELECT * from folders where folder_id = $folderid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $folderlock = $row['folder_lock'];
    if ($folderlock == 0) {
        $updatelock = "1";
    }
    else {
        $updatelock = "0";
    }

    $pinsql = "SELECT * from users where user_id = $user";
    $verifyresult = $conn->query($pinsql);

        if ($verifyresult->num_rows > 0) {
        while($pinrow = $verifyresult->fetch_assoc()) {
            $hashed = $pinrow['user_pin'];
            if (password_verify($pin, $hashed)) {
                $updatelockstatus = "UPDATE folders SET folder_lock ='{$updatelock}' WHERE folder_id = $folderid";

                if ($conn->query($updatelockstatus) === TRUE) {
                    $_SESSION['locked'] = "muvaffaqiyatli";
                    header("location: $redirect");
                } else {
                    $_SESSION['error'] = "muvaffaqiyatli";
                    header("location: $redirect");
                } 
            }else {
                $_SESSION['pin_notmatch'] = "muvaffaqiyatli";
                header("location: $redirect");
            }
  }
} else {
  echo "0 natija";
}

  }
} else {
  echo "0 natija";
}

?>