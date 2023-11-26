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
$VID=$_POST['seetype'];

$query = "SELECT *
          FROM transitvehicle tv, transittrain tt
          WHERE tv.VID ='$VID' AND tt.Vehicle_ID ='$VID'";

$result = $conn->query($query);
if($result->num_rows <= 0){
    $query = "SELECT *
              FROM transitvehicle tv, transitbus tb
              WHERE tv.VID ='$VID' AND tb.Vehicle_ID ='$VID'";
    $result = $conn->query($query);
    echo "<h1 style=\"text-align:center;\">Vehicle Type<h1>";
    echo "<table align=\"center\" border= \"1\" style=\"font-size:1.1em;\">";
    echo "<tr>
    <th>VID</th>
    <th>D_ID</th>
    <th>T_Capacity</th>
    <th>Status</th>
    <th>Bus_License_Number</th>      
    </tr>";
    if($result->num_rows > 0){
	    // Output Data of Each Row
	    while($row = $result->fetch_assoc()){
		    echo "<tr>";
            echo "<td>".$row['VID']."</td>";
            echo "<td>".$row['D_ID']."</td>";
            echo "<td>".$row['T_Capacity']."</td>";
            echo "<td>".$row['Status']."</td>";
            echo "<td>".$row['License_Number']."</td>";
            echo "</tr>";
	    }
        echo "</table>";
    }
    else{
	    echo "0 results";
    }
}else{
    echo "<h1 style=\"text-align:center;\">Vehicle Type<h1>";
    echo "<table align=\"center\" border= \"1\" style=\"font-size:1.1em;\">";
    echo "<tr>
    <th>VID</th>
    <th>D_ID</th>
    <th>T_Capacity</th>
    <th>Status</th>
    <th>Train_Number</th>
    <th>Number_Of_Cars</th>    
    </tr>";
    if($result->num_rows > 0){
	    // Output Data of Each Row
	    while($row = $result->fetch_assoc()){
		    echo "<tr>";
            echo "<td>".$row['VID']."</td>";
            echo "<td>".$row['D_ID']."</td>";
            echo "<td>".$row['T_Capacity']."</td>";
            echo "<td>".$row['Status']."</td>";
            echo "<td>".$row['Train_Number']."</td>";
            echo "<td>".$row['Number_Of_Cars']."</td>";
            echo "</tr>";
	    }
        echo "</table>";
    }
    else{
	    echo "0 results";
    }
}


$conn->close();
?>