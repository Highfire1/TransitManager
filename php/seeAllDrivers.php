<?php

include 'DBUtilities.php';
$conn = createDBConnection();

$query = "SELECT DID, DName, DLicense FROM driver";
$result = $conn->query($query);

echo "<h1 style=\"text-align:center;\">All Drivers<h1>";
echo "<table align=\"center\" border= \"1\" style=\"font-size:1.1em;\">";
echo "<tr>
<th>DID</th>
<th>DName</th>
<th>DLicense</th>
       
</tr>";
if($result->num_rows > 0){
	// Output Data of Each Row
	while($row = $result->fetch_assoc()){
		echo "<tr>";
        echo "<td>".$row['DID']."</td>";
        echo "<td>".$row['DName']."</td>";
        echo "<td>".$row['DLicense']."</td>";
        echo "</tr>";
	}
    echo "</table>";
}
else{
	echo "0 results";
}

$conn->close();
?>