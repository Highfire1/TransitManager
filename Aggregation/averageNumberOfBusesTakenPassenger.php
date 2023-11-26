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


$query = "SELECT AVG(busCount) as averageBusesTaken
    FROM (
    SELECT P_ID, COUNT(*) as busCount
    FROM passengerridestransit
    GROUP BY P_ID
    ) as BusCounts";
$result = $conn->query($query);

echo "<h1 style=\"text-align:center;\">Average Buses Taken<h1>";

if ($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $averageBuses = $row["averageBusesTaken"];
    echo "<p style=\"font-size: 1.1em; text-align:center;\">Average buses taken: " . round($averageBuses) . "</p>";
}
else {
    echo "0 results";
}

$conn->close();
?>