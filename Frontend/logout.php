<?php
session_start();

// Check if the session is active
if (isset($_SESSION['user_id'])) {
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "home";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Update user's status to 'inactive'
        $stmt = $conn->prepare("UPDATE users SET status = 'inactive' WHERE userID = :userID");
        $stmt->bindParam(':userID', $_SESSION['user_id']);
        $stmt->execute();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Destroy the session
    session_unset();
    session_destroy();
}

// Redirect to the login page or any other page after logout
header("Location: logout_message.php");
exit();
?>
