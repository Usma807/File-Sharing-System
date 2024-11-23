<?php
include '../config.php';
session_start();

$redirect = $_SERVER['HTTP_REFERER'];

$docid = $_GET['docid'];

$delete = "DELETE FROM sharefolder_documents WHERE sfdoc_id = $docid";

if ($conn->query($delete) === TRUE) {
    $_SESSION['doc_delete_sf'] = "muvaffaqiyatli";
    header("location: $redirect");
  } else {
    echo "Xato: " . $conn->error;
  }

?>