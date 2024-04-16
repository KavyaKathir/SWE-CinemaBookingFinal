<?php
// Database connection
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

// Get promo code from POST request
$promoCode = $_POST['promoCode'];

// Prepare and execute SQL statement to fetch discount based on promo code
$stmt = $conn->prepare("SELECT discount FROM promotion WHERE promotionCode = ?");
$stmt->bind_param("s", $promoCode);
$stmt->execute();
$result = $stmt->get_result();

// Check if promo code exists and fetch the discount
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row['discount']; // Output the discount
} else {
    echo "0"; // If promo code not found, return 0 discount
}

$stmt->close();
$conn->close();
?>
