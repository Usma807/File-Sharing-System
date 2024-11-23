<?php
include '../config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $folderName = $_POST["folder"];
    $user = $_SESSION['user_id'];
$redirect = $_SERVER['HTTP_REFERER'];

    $directory = "../folders_list/"; 

    if (!file_exists($directory . $folderName)) {
        if (mkdir($directory . $folderName, 0777, true)) {

            $sql = "INSERT INTO folders (folder_user, folder_name) VALUES ('$user', '$folderName')";

            if ($conn->query($sql) === TRUE) {
                $_SESSION['new_folder_created'] = "muvaffaqiyatli";
                    header("location: $redirect");
            } else {
                echo "Xato: " . $conn->error;
            }

            $conn->close();
        } else {
            echo "Xato.";
        }
    } else {
        $_SESSION['folder_exists'] = "muvaffaqiyatli";
                    header("location: $redirect");
    }
}
?>