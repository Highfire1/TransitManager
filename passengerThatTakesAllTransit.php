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

$query = "SELECT PID, Name
          FROM passenger p
          WHERE p.PID = any(
            SELECT PID
            FROM passenger p2
            WHERE NOT EXISTS(
                SELECT * 
                FROM transitvehicle tv
                WHERE NOT EXISTS(
                    SELECT V_ID
                    FROM passengerridestransit tr
                    WHERE p2.PID = tr.P_ID AND tr.V_ID = tv.VID
                    )
            )
          )
          ";
$result = $conn->query($query);

echo "<h1 style=\"text-align:center;\">Passenger(s) That has Taken All Transit<h1>";
echo "<table align=\"center\" border= \"1\" style=\"font-size:1.1em;\">";
echo "<tr>
<th>PID</th>
<th>Name</th> 
</tr>";
if($result->num_rows > 0){
	// Output Data of Each Row
	while($row = $result->fetch_assoc()){
		echo "<tr>";
        echo "<td>".$row['PID']."</td>";
        echo "<td>".$row['Name']."</td>";
        echo "</tr>";
	}
    echo "</table>";
}
else{
	echo "0 results";
}

$conn->close();
?>