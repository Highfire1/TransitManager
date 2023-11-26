<?php
include 'connect-totransit.php';
$conn = OpenCon();
echo "Connected Successfully";
CloseCon($conn);
// http://localhost/groupProject/check-transitconnection.php
?>
