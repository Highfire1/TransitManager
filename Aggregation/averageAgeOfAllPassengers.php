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
echo "<h1 style=\"text-align:center;\">Average Age<h1>";

$query = "SELECT AVG(Age) AS AverageAge FROM Passenger";
$result = $conn->query($query);

if ($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $averageAge = $row["AverageAge"];
    echo "<p style=\"font-size: 1.1em; text-align:center;\">Average age of ALL passengers: " . round($averageAge) . "</p>";
}
else {
    echo "0 results";
}

$conn->close();
?>