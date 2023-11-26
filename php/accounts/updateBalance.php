<?php

include '../../DBUtilities.php';
$conn = createDBConnection();




$PID = $_POST['PID'];
$BAL_CHANGE = $_POST['balchange'];
$PRECOMPUTED = $_POST['precomputed_value'];

// var_dump($_POST);

if (!isset($_POST["PID"]) || !isset($_POST["balchange"])) {
    echo "Query Error.";
    return;
}

$query = "SELECT * FROM Card WHERE PassID = '$PID'";
$card = $conn->query($query);

if ($card->num_rows == 0) {
    return "<h1 style=\"text-align:center;\">User not found.</h1>";
}

$card = $card->fetch_assoc();

$old_balance = $card["Balance"];
$new_balance = $old_balance + floatval($BAL_CHANGE);
$pre_computed = floatval($PRECOMPUTED);

// echo $new_balance . $pre_computed ;

if ($new_balance != $pre_computed) {
    // echo $new_balance . $pre_computed ;
    echo "<h1 style=\"text-align:center;\">This transaction has already occured.</h1>";
    return;
}

$query = "UPDATE Card SET Balance = '$new_balance' WHERE PassID = '$PID'";
$conn->query($query);
$conn->close();



echo "<h1 style=\"text-align:center;\">Balance Updated.</h1>";
echo "$$old_balance + $$BAL_CHANGE => $$new_balance";
echo "<br>";
// echo " <button onclick=\"window.location=document.referrer;\">Go Back</button>"
?>