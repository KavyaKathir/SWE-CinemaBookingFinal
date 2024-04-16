<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are set and not empty
    if (
        isset($_POST['add_code']) && isset($_POST['add_discount']) &&
        isset($_POST['add_start']) && isset($_POST['add_end']) &&
        !empty($_POST['add_code']) && !empty($_POST['add_discount']) &&
        !empty($_POST['add_start']) && !empty($_POST['add_end'])
    ) {
        // Database configuration
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "home";

        try {
            // Create connection
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // Set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare SQL statement to insert promotion
            $stmt = $conn->prepare("INSERT INTO promotion (promotionCode, discount, startDate, expirationDate)
            VALUES (:promotionCode, :discount, :startDate, :expirationDate)");

            // Bind parameters
            $stmt->bindParam(':promotionCode', $_POST['add_code']);
            $stmt->bindParam(':discount', $_POST['add_discount']);
            $stmt->bindParam(':startDate', $_POST['add_start']);
            $stmt->bindParam(':expirationDate', $_POST['add_end']);

            // Execute SQL statement
            $stmt->execute();

            echo "Promotion added successfully.";
        } catch (PDOException $e) {
            // Display error message
            echo "Error: " . $e->getMessage();
        }

        // Close connection
        $conn = null;
    } else {
        echo "Please fill all the fields.";
    }
}
?>
