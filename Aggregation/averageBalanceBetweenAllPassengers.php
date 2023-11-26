<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "transit";

$conn = new mysqli($servername, $username, $password, $dbname);
// Checking Connection
if($conn->connect_error){
	die("Connection Failed: " . $conn->connect_error);
}

$query = "SELECT AVG(Balance) AS AverageBalance FROM Card";
$result = $conn->query($query);

echo "<h1 style=\"text-align:center;\">Average Balance<h1>";

if ($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $averageBalance = $row["AverageBalance"];
    echo "<p style=\"font-size: 1.1em; text-align:center;\">Average balance of ALL passengers: $" . round($averageBalance) . "</p>";
}
else {
    echo "0 results";
}

$conn->close();
?>