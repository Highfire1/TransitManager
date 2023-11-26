<?php

include 'DBUtilities.php';
$conn = createDBConnection();

$query = "SELECT * FROM route";
$result = $conn->query($query);

echo "<h1 style=\"text-align:center;\">All Routes<h1>";
echo "<table align=\"center\" border= \"1\" style=\"font-size:1.1em;\">";
echo "<tr>
<th>RID</th>
<th>R_start</th>
<th>Destination</th>
       
</tr>";
if($result->num_rows > 0){
	// Output Data of Each Row
	while($row = $result->fetch_assoc()){
		echo "<tr>";
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