<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "transit";

$conn = new mysqli($servername, $username, $password, $dbname);
// Checking Connection
if($conn->connect_error){
	die("Connection Failed: " . $conn->connect_error);
}


    $selectedColumns = array();
    if (isset($_POST["columns"])) {
        $selectedColumns = $_POST["columns"];
    }

    if (empty($selectedColumns)) {
        echo"<p style=\"font-size:1.7em;\">Please select at least one column<p>";
    }
    else {
        $query = "SELECT " . implode(", ", $selectedColumns) . " FROM Passenger P LEFT JOIN Card C ON P.PID = C.PassID";
        $result = $conn->query($query);

        echo "<h1 style = \"text-align:center;\">Passenger Projection</h1>";
        echo "<table align=\"center\" border= \"1\" style=\"font-size:1.7em;\">";
        echo "<tr>";

        foreach ($selectedColumns as $column) {
            echo "<th>$column</th>";
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($selectedColumns as $column) {
                    echo "<td>" . $row[$column] . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No results found.";
        }
    }


$conn->close();
?>