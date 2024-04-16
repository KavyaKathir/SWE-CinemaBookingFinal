<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve selected user's first and last name from the form
    $userid = $_POST['promoUser'];

    // Connect to the database
    $servername = "localhost"; // Change this to your server name if it's different
    $username = "root";
    $password = "";
    $database = "home";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Retrieve user's ID using first and last name

        $userID = $userid;

        // Retrieve user's email
        $stmtUserEmail = $pdo->prepare("SELECT email FROM users WHERE userID = ?");
        $stmtUserEmail->execute([$userID]);
        $userEmail = $stmtUserEmail->fetchColumn();

        // Retrieve promotion details from the form
        $promotionCode = $_POST['promoName'];

        // Retrieve promotion details
        $stmtPromotion = $pdo->prepare("SELECT * FROM promotion WHERE promotionCode = ?");
        $stmtPromotion->execute([$promotionCode]);
        $promotionDetails = $stmtPromotion->fetch(PDO::FETCH_ASSOC);

        // Compose email message
        $subject = "Promotion: $promotionCode";
        $message = "Dear User,\n\nYou've been selected for our special promotion. Here are the details:\n\n";
        $message .= "Promotion Code: " . $promotionDetails['promotionCode'] . "\n";
        $message .= "Discount Percent: " . $promotionDetails['discount'] . "%\n";
        // Add any other promotion details you want to include

        $headers = "From: MOVIELANE BOOKING"; // Replace with your email

        // Send email
        if (mail($userEmail, $subject, $message, $headers)) {

        } else {
            echo "Failed to send promotion email.";
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
