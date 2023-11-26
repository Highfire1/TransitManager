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

$query = "SELECT VID, D_ID, T_Capacity, Status FROM transitvehicle";
$result = $conn->query($query);

echo "<h1 style=\"text-align:center;\">All Vehicles<h1>";
echo "<table align=\"center\" border= \"1\" style=\"font-size:1.1em;\">";
echo "<tr>
<th>VID</th>
<th>D_ID</th>
<th>T_Capacity</th>
<th>Status</th>         
</tr>";
if($result->num_rows > 0){
	// Output Data of Each Row
	while($row = $result->fetch_assoc()){
		echo "<tr>";
        echo "<td>".$row['VID']."</td>";
        echo "<td>".$row['D_ID']."</td>";
        echo "<td>".$row['T_Capacity']."</td>";
        echo "<td>".$row['Status']."</td>";
        echo "</tr>";
	}
    echo "</table>";
}
else{
	echo "0 results";
}

$conn->close();
?>