<?php
$servername = "localhost";
$username = "root"; //my username
$password = "root"; // my password
$dbname = "transitmanager";

// Creating Connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Checking Connection
if($conn->connect_error){
	die("Connection Failed: " . $conn->connect_error);
}

$RID=$_POST['routeid'];

$query = "SELECT Route.RID, Route.R_start, Route.destination FROM Route INNER JOIN Route_IsTransferable ON Route.RID = Route_IsTransferable.R_ID2 WHERE Route_IsTransferable.R_ID1 = '$RID'";
$result = $conn->query($query);

echo "<h1 style=\"text-align:center;\">Transferable Routes</h1>";
echo "<table align=\"center\" border=\"1\" style=\"font-size:1.1em;\">";
echo "<tr>
        <th>RID</th>
		<th>R_start</th>
        <th>destination</th>
     </tr>";

	 if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>" . $row['RID'] . "</td>";
			echo "<td>" . $row['R_start'] . "</td>";
        	echo "<td>" . $row['destination'] . "</td>";
			echo "</tr>";
		}
		echo "</table>";
	} else {
		echo "0 results";
	}

$conn -> close();
?>