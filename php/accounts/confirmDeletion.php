<?php
include '../../DBUtilities.php';
$conn = createDBConnection();


$PID = $_POST['PID'];

echo "<h1 style=\"text-align:center;\">Are you sure you want to delete your account? You will NOT BE ABLE TO RECOVER YOUR BALANCE.</h1>";


echo "<form action=\"deletePassenger.php\" method=\"post\">
<fieldset>
    <legend><strong>CONFIRM</strong></legend>
    
    <input type=\"hidden\" id=\"PID\" name=\"PID\" value=\"$PID\">
    <input type=\"submit\" value=\"CONFIRM\">
</fieldset>
</form>";
?>