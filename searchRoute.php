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

echo "<h1 style=\"text-align:center;\">Route</h1>";
echo "<table align=\"center\" border=\"1\" style=\"font-size:1.1em;\">";
echo "<tr>
        <th>RID</th>
		<th>R_start</th>
        <th>R_destination</th>
     </tr>";

	 if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>" . $row['RID'] . "</td>";
			echo "<td>" . $row['R_start'] . "</td>";
        	echo "<td>" . $row['Destination'] . "</td>";
			echo "</tr>";
		}
		echo "</table>";
	} else {
		echo "0 results";
	}

$conn -> close();
?>

