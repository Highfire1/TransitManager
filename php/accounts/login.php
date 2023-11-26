<?php
include '../../DBUtilities.php';
$conn = createDBConnection();


$PASSID = $_POST['passengerID'];

$query = "SELECT * FROM Passenger WHERE PID = '$PASSID'";
$passenger = $conn->query($query);

if ($passenger->num_rows == 0) {
    echo "<h1 style=\"text-align:center;\">User not found.</h1>";
    return;
}

$query = "SELECT * FROM Card WHERE PassID = '$PASSID'";
$card = $conn->query($query);

$passenger = $passenger->fetch_assoc();
$card = $card->fetch_assoc();

$conn->close();


echo "<h1 style=\"text-align:center;\">Hello " . $passenger['Name'] . ".</h1>";

echo "<table align=\"center\" border= \"1\" style=\"font-size:1.1em;\">";
echo "<tr>
<th>PID</th>
<th>Name</th>
<th>Age</th>
</tr>";

echo "<tr>";
echo "<td>".$passenger['PID']."</td>";
echo "<td>".$passenger['Name']."</td>";
echo "<td>".$passenger['Age']."</td>";
echo "</tr>";
echo "</table>";

echo "<br>";


echo "<table align=\"center\" border= \"1\" style=\"font-size:1.1em;\">";
echo "<tr>
<th>CID</th>
<th>Balance</th>
<th>Card Type</th>
</tr>";

echo "<tr>";
echo "<td>".$card['CID']."</td>";
echo "<td>".$card['Balance']."</td>";
echo "<td>".$card['CType']."</td>";
echo "</tr>";
echo "</table>";


echo "<form action=\"updateBalance.php\" method=\"post\">
<fieldset>
    <legend><strong>Update Balance</strong></legend>
    
    <input type=\"hidden\" id=\"PID\" name=\"PID\" value=\"$PASSID\">
    
    <label for=\"balchange\">Balance:</label>
    <select id=\"balchange\" name=\"balchange\" onchange=\"computeValue(this.value)\">
        <option value=\"10\">$10</option>
        <option value=\"20\">$20</option>
        <option value=\"50\">$50</option>
        <option value=\"100\">$100</option>
    </select>

    <input type=\"hidden\" id=\"precomputed_value\" name=\"precomputed_value\" value=\"\">

    <br>
    <input type=\"submit\" value=\"Submit\">
</fieldset>
</form>";

echo "<script>
    window.onload = function() {
        var balance = " . $card['Balance'] . ";
        var select = document.getElementById('balchange');
        var precomputedValueField = document.getElementById('precomputed_value');

        function computeValue() {
            var selectedValue = parseFloat(select.value);
            var precomputedValue = parseFloat(balance) + selectedValue;
            precomputedValueField.value = precomputedValue.toFixed(2);
        }

        computeValue(); // Run the computation function on page load

        select.addEventListener('change', computeValue); // Update on select change
    };
</script>";


echo "<form action=\"confirmDeletion.php\" method=\"post\">
<fieldset>
    <legend><strong>Delete Account:</strong></legend>
    
    <input type=\"hidden\" id=\"PID\" name=\"PID\" value=\"$PASSID\">

    <input type=\"submit\" value=\"Delete Account\" style=\"background-color: red; color: white; border: none; padding: 10px 20px; border-radius: 5px;\">
</fieldset>
</form>";

?>