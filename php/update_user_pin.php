<?php
include '../config.php';
session_start();

$user = $_SESSION['user_id'];
$pin = $_POST['pin'];
$hashed_pin = password_hash($pin, PASSWORD_DEFAULT); 
$password = $_POST['password'];
$redirect = $_SERVER['HTTP_REFERER'];

$pwd = "SELECT password from users where user_id = $user";
$pwdresult = $conn->query($pwd);

if ($pwdresult->num_rows > 0) {
  while($pwdrow = $pwdresult->fetch_assoc()) {
    $hashed = $pwdrow['password']; 
    if (password_verify($password, $hashed)) {
        $update = "UPDATE users SET user_pin ='{$hashed_pin}' WHERE user_id=$user";

                if ($conn->query($update) === TRUE) {
                    $_SESSION['pinchanged'] = "muvaffaqiyatli";
                    header("location: $redirect");
                } else {
                echo "Xato: " . $conn->error;
                }
    }else {
        $_SESSION['wrongpwd'] = "muvaffaqiyatli";
        header("location: $redirect");
    }
  }
} else {
  echo "0 natija";
}

?>