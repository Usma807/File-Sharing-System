<?php
include "../config.php";
session_start();

$redirect = $_SERVER['HTTP_REFERER'];
$docid = $_GET['docid'];

$sql = "SELECT * FROM documents WHERE doc_id = $docid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $docName = $row['doc_name'];
    $docFilePath = $row['doc_path']; 

    $delete = "DELETE FROM documents WHERE doc_id = $docid";

    if (unlink($docFilePath)) {
        if ($conn->query($delete) === TRUE) {
            $_SESSION['doc_delete'] = $docName;
            header("location: $redirect");
        } else {
            echo "Xato: " . $conn->error;
        }
    } else {
        echo "Xatolik.";
    }

    $conn->close();
} else {
    echo "Hujjat topilmadi!";
}
?>
