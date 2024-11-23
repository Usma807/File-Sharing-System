<?php
include '../config.php';
session_start();

$redirect = $_SERVER['HTTP_REFERER'];
$sfid = $_GET['sfid'];

$sfdocs = "DELETE FROM sharefolder_documents WHERE sfdoc_sfid = $sfid";

if ($conn->query($sfdocs) === TRUE) {
            $sfmembers = "DELETE FROM sharefolder_members where member_sf= $sfid";

            if ($conn->query($sfmembers) === TRUE) {
                        $delsf = "DELETE FROM sharefolder where sf_id= $sfid";

                        if ($conn->query($delsf) === TRUE) {
                            $_SESSION['sfdelete'] = "muvaffaqiyatli";
                            header("location: $redirect");
                        } else {
                        echo "Xato: " . $conn->error;
                        }
            } else {
            echo "Xato: " . $conn->error;
            }
} else {
  echo "Xato : " . $conn->error;
}
?>