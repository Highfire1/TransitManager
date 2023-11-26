<?php
include '../../DBUtilities.php';
$conn = createDBConnection();



//get highest pid
$query = "SELECT MAX(PID) AS max_pid FROM Passenger";
$result = $conn->query($query);
$row_pid = $result->fetch_assoc();
$highest_pid = $row_pid['max_pid'];

// get highest cid
$query = "SELECT MAX(CID) AS max_cid FROM Card";
$result = $conn->query($query);
$row_cid = $result->fetch_assoc();
$highest_cid = $row_cid['max_cid'];

// Increment the values by one
$new_pid = $highest_pid + 1;
$new_cid = $highest_cid + 1;

$NAME = $_POST['name'];
$AGE = $_POST['age'];
$CTYPE = $_POST['ctype'];


$query = "INSERT INTO Passenger VALUES ($new_pid, '$NAME', $AGE)";
$card = $conn->query($query);

$query = "INSERT INTO Card VALUES ($new_pid, $new_cid, 0, '$CTYPE')";
$card = $conn->query($query);

$conn->close();

echo "<h1 style=\"text-align:center;\">User Created.</h1>";
echo "<p>Your ID is $new_pid";
echo "<br>";
echo "<a href=\"/account.html\">Go to Login Page</a>";
// <form style=\"text-align:center; action=\"/php/accounts/login.php\" method=\"post\">
//     <input type=\"hidden\" id=\"cardID\" name=\"cardID\" value=\"$new_cid\">
//     <label for=\"cardID\" style=\"display:none;\">Card ID:</label>
//     <input type=\"submit\" value=\"Go to Account Page\">
// </form>";

?>