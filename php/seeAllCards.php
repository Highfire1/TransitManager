<?php

include 'DBUtilities.php';
$conn = createDBConnection();

$query = "SELECT PassID, CID, Balance FROM card";
$result = $conn->query($query);

echo "<h1 style=\"text-align:center;\">All Cards<h1>";
echo "<table align=\"center\" border= \"1\" style=\"font-size:1.1em;\">";
echo "<tr>
<th>PassID</th>
<th>CID</th>
<th>Balance</th>        
</tr>";
if($result->num_rows > 0){
	// Output Data of Each Row
	while($row = $result->fetch_assoc()){
		echo "<tr>";
        echo "<td>".$row['PassID']."</td>";
        echo "<td>".$row['CID']."</td>";
        echo "<td>".$row['Balance']."</td>";
        echo "</tr>";
	}
    echo "</table>";
}
else{
	echo "0 results";
}

$conn->close();
?>