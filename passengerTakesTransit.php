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
$PID=$_POST['id'];

$query = "SELECT PID, Name, V_ID
          FROM passenger,passengerridestransit
          WHERE PID='$PID' AND PID=P_ID";
$result = $conn->query($query);

echo "<h1 style=\"text-align:center;\">Passenger Rides Transit<h1>";
echo "<table align=\"center\" border= \"1\" style=\"font-size:1.1em;\">";
echo "<tr>
<th>PID</th>
<th>Name</th>
<th>VID</th>  
</tr>";
if($result->num_rows > 0){
	// Output Data of Each Row
	while($row = $result->fetch_assoc()){
		echo "<tr>";
        echo "<td>".$row['PID']."</td>";
        echo "<td>".$row['Name']."</td>";
        echo "<td>".$row['V_ID']."</td>";

        echo "</tr>";
	}
    echo "</table>";
}
else{
	echo "0 results";
}

$conn->close();
?>