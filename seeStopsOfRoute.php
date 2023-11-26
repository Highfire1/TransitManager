<?php
$servername = "localhost";
$username = "root"; //my username
$password = "root"; // my password
$dbname = "transit";

// Creating Connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Checking Connection
if($conn->connect_error){
	die("Connection Failed: " . $conn->connect_error);
}

$RID=$_POST['routeid'];

$query = "SELECT Stop.SID, Stop.Address FROM Stop JOIN RouteHasStop ON Stop.SID = RouteHasStop.S_ID WHERE RouteHasStop.R_ID = '$RID'";
$result = $conn->query($query);

echo "<h1 style=\"text-align:center;\">Stops in Route</h1>";
echo "<table align=\"center\" border=\"1\" style=\"font-size:1.1em;\">";
echo "<tr>
        <th>Stop ID</th>
        <th>Stop Name</th>
      </tr>";

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		echo "<tr>";
        echo "<td>" . $row["SID"] . "</td>";
        echo "<td>" . $row["Address"] . "</td>";
        echo "</tr>";
	}
        echo "</table>";
} else {
	echo "0 results";
}

$conn -> close();
?>