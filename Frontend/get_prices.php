<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "home";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch prices from the database
$sql = "SELECT * FROM prices";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output prices as JSON
    $row = $result->fetch_assoc();
    $prices = array(
        "childPrice" => $row["childPrice"],
        "adultPrice" => $row["adultPrice"],
        "seniorPrice" => $row["seniorPrice"],
        "salesTax" => $row["salesTax"],
        "bookingFee" => $row["bookingFee"]
    );
    echo json_encode($prices);
} else {
    echo json_encode(array("error" => "No prices found"));
}

// Close connection
$conn->close();
?>
