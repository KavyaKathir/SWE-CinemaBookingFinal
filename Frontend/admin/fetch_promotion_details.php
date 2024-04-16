<?php
// Assuming you have already established a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "home";

// Create connection
$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// Set the PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Function to fetch promotion details based on selected promotion name
function fetchPromotionDetails($pdo, $promotionName) {
    $stmt = $pdo->prepare("SELECT * FROM promotion WHERE promotionCode = :promotionName");
    $stmt->bindParam(':promotionName', $promotionName);
    $stmt->execute();
    $promotionDetails = $stmt->fetch(PDO::FETCH_ASSOC);
    return $promotionDetails;
}

if (isset($_GET['promotion_name'])) {
    $promotionName = $_GET['promotion_name'];
    // Fetch promotion details
    $stmt = $pdo->prepare("SELECT * FROM promotion WHERE promotionCode = :promotionName");
    $stmt->bindParam(':promotionName', $promotionName);
    $stmt->execute();
    $promotionDetails = $stmt->fetch(PDO::FETCH_ASSOC);

    // Send promotion details as JSON response
    echo json_encode($promotionDetails);
    exit;
}
?>
