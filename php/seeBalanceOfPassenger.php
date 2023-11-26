<?php
include 'DBUtilities.php';
$conn = createDBConnection();

$PID=$_POST['id'];

$query = "SELECT PID, Name, CID, Balance, CType 
          FROM passenger, card
          WHERE PID='$PID' AND PID=PassID";
$result = $conn->query($query);

echo "<h1 style=\"text-align:center;\">Balance<h1>";
echo "<table align=\"center\" border= \"1\" style=\"font-size:1.1em;\">";
echo "<tr>
<th>PID</th>
<th>Name</th>
<th>CID</th>    
<th>Balance</th> 
<th>CType</th>     
</tr>";
if($result->num_rows > 0){
	// Output Data of Each Row
	while($row = $result->fetch_assoc()){
		echo "<tr>";
        echo "<td>".$row['PID']."</td>";
        echo "<td>".$row['Name']."</td>";
        echo "<td>".$row['CID']."</td>";
        echo "<td>".$row['Balance']."</td>";
        echo "<td>".$row['CType']."</td>";
        echo "</tr>";
	}
    echo "</table>";
}
else{
	echo "0 results";
}

$conn->close();
?>