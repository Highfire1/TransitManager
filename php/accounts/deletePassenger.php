<?php
include '../../DBUtilities.php';
$conn = createDBConnection();



$PID = $_POST['PID'];


// This will cascade delete linked Cards as well.
$query = "DELETE FROM Passenger WHERE PID='$PID'";
$result = $conn->query($query);
$conn->close();

echo "<h1 style=\"text-align:center;\">Your account has been deleted.</h1>";
?>