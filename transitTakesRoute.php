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

$VID=$_POST['vehicleid'];

$query = "SELECT tv.VID, r.RID, r.R_start, r.Destination
          FROM transitvehicle tv, transittakesroute ttr, route r
          WHERE tv.VID ='$VID' AND tv.VID = ttr.V_ID AND ttr.R_ID = r.RID
          ";
$result = $conn->query($query);

echo "<h1 style=\"text-align:center;\">Route Taken by Vehicle<h1>";
echo "<table align=\"center\" border= \"1\" style=\"font-size:1.1em;\">";
echo "<tr>
<th>VID</th>
<th>RID</th>
<th>Start</th>
<th>Destination</th>       
</tr>";
if($result->num_rows > 0){
	// Output Data of Each Row
	while($row = $result->fetch_assoc()){
		echo "<tr>";
        echo "<td>".$row['VID']."</td>";
        echo "<td>".$row['RID']."</td>";
        echo "<td>".$row['R_start']."</td>";
        echo "<td>".$row['Destination']."</td>";
        echo "</tr>";
	}
    echo "</table>";
}
else{
	echo "0 results";
}

$conn->close();
?>