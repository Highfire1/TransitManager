<?php declare(strict_types=1);


$DID=$_POST['driverid'];




include 'DBUtilities.php';
$conn = createDBConnection();

$query = "SELECT DID, DName, VID 
          FROM driver d, transitvehicle tv
          WHERE d.DID = '$DID' AND d.DID = tv.D_ID 
          ";
$result = $conn->query($query);
$conn->close();




echo "<h1 style=\"text-align:center;\">Driver Drives Vehicle<h1>";
echo "<table align=\"center\" border= \"1\" style=\"font-size:1.1em;\">";
echo "<tr>
<th>DID</th>
<th>DName</th>
<th>VID</th>
</tr>";
if($result->num_rows > 0){
	// Output Data of Each Row
	while($row = $result->fetch_assoc()){
		echo "<tr>";
        echo "<td>".$row['DID']."</td>";
        echo "<td>".$row['DName']."</td>";
        echo "<td>".$row['VID']."</td>";
        echo "</tr>";
	}
    echo "</table>";
}
else{
	echo "0 results";
}

?>