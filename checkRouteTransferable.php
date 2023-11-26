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

$query1 = "SELECT Route.RID, Route.R_start, Route.Destination FROM Route INNER JOIN Route_IsTransferable ON Route.RID = Route_IsTransferable.R_ID2 WHERE Route_IsTransferable.R_ID1 = '$RID'";
$result1 = $conn->query($query1);

$query2 = "SELECT Route.RID, Route.R_start, Route.Destination FROM Route INNER JOIN Route_IsTransferable ON Route.RID = Route_IsTransferable.R_ID1 WHERE Route_IsTransferable.R_ID2 = '$RID'";
$result2 = $conn->query($query2);



if($result1->num_rows > 0){
	echo "<h1 style=\"text-align:center;\">Transferable Routes</h1>";
	echo "<table align=\"center\" border=\"1\" style=\"font-size:1.1em;\">";
	echo "<tr>
      	  <th>RID</th>
	  	  <th>R_start</th>
      	  <th>R_destination</th>
      	  </tr>";
	while ($row = $result1->fetch_assoc()) {
		echo "<tr>";
		echo "<td>" . $row['RID'] . "</td>";
		echo "<td>" . $row['R_start'] . "</td>";
        echo "<td>" . $row['Destination'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
}else{
	if ($result2->num_rows > 0) {
		echo "<h1 style=\"text-align:center;\">Transferable Routes</h1>";
		echo "<table align=\"center\" border=\"1\" style=\"font-size:1.1em;\">";
		echo "<tr>
				<th>RID</th>
				<th>R_start</th>
				<th>R_destination</th>
				</tr>";
		while ($row = $result2->fetch_assoc()) {
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
}


$conn -> close();
?>