<?php
include '../config.php';
session_start();

$redirect = $_SERVER['HTTP_REFERER'];
$userid = $_SESSION['user_id'];
$docid = $_POST['docid'];
$sfid = $_POST['sharefolder'];


$find_sql = "SELECT count(sfdoc_id) as records from sharefolder_documents where sfdoc_sfid = $sfid AND sfdoc_docid = $docid";
$record_results = $conn->query($find_sql);

if ($record_results->num_rows > 0) {
  while($totalrecords = $record_results->fetch_assoc()) {
    $records = $totalrecords['records'];
    if ($records == 0) {
        $sql = "INSERT INTO sharefolder_documents ( sfdoc_user, sfdoc_sfid, sfdoc_docid)
        VALUES ('$userid', '$sfid', '$docid')";
        
        if ($conn->query($sql) === TRUE) {
            $_SESSION['sharedsuccess'] = "muvaffaqiyatli";
            header("location: $redirect");
        } else {
          echo "Xato: " . $sql . "<br>" . $conn->error;
        }   
    }
    else {
        $_SESSION['sfdocexists'] = "muvaffaqiyatli";
            header("location: $redirect");
    }
  }
} else {
  echo "0 natija";
}



?>