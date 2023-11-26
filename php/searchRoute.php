<?php
$servername = "localhost";
$username = "root"; //my username
$password = "root"; // my password
$dbname = "transit";

$RID=$_POST['routeid'];
// Creating Connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Checking Connection
if($conn->connect_error){
	die("Connection Failed: " . $conn->connect_error);
}

$query = "SELECT * FROM route WHERE RID = '$RID'";
$result = $conn->query($query);

$queryStops = "SELECT Stop.SID, Stop.StopName FROM Stop JOIN RouteHasStop ON Stop.SID = RouteHasStop.S_ID WHERE RouteHasStop.R_ID = '$RID'";
$resultStops = $conn->query($queryStops);

echo "<h2>Stops in $RID:";
if ($result_stops->num_rows > 0) {
	while ($row = $result_stops->fetch_assoc()) {
		echo "Stop ID: " . $row["SID"] . ", Stop Name: " . $row["Address"] . "<br>";
	}
} else {
	echo "No stops found for Route $route_id";
}

$conn -> close();
?>

