<?php

include 'DBUtilities.php';
$conn = createDBConnection();


$PID=$_POST['id'];

$query = "SELECT PID, Name, Age FROM passenger WHERE PID='$PID'";
$result = $conn->query($query);

echo "<h1 style=\"text-align:center;\">Passenger<h1>";
echo "<table align=\"center\" border= \"1\" style=\"font-size:1.1em;\">";
echo "<tr>
<th>PID</th>
<th>Name</th>
<th>Age</th>        
</tr>";
if($result->num_rows > 0){
	// Output Data of Each Row
	while($row = $result->fetch_assoc()){
		echo "<tr>";
        echo "<td>".$row['PID']."</td>";
        echo "<td>".$row['Name']."</td>";
        echo "<td>".$row['Age']."</td>";
        echo "</tr>";
	}
    echo "</table>";
}
else{
	echo "0 results";
}

$conn->close();
?>