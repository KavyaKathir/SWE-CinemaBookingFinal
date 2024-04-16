<?php
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

// Check if user ID is provided in the request
if(isset($_GET['userID'])) {
    $userID = $_GET['userID'];

    // Prepare SQL statement to fetch user details
    $sql = "SELECT firstName, lastName, email,password FROM users WHERE userID = ?";
    $stmt = $conn->prepare($sql);

    // Bind the user ID parameter
    $stmt->bind_param("i", $userID);

    // Execute the statement
    $stmt->execute();

    // Bind result variables
    $stmt->bind_result($firstName, $lastName, $email,$password);

    // Fetch user details
    if($stmt->fetch()) {
        // Return user details as JSON response
        $userDetails = array(
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
              'password' => $password
        );

        // Output user details as JSON
        echo json_encode($userDetails);
    } else {
        // User not found
        echo json_encode(array('error' => 'User not found'));
    }

    // Close statement
    $stmt->close();
} else {
    // User ID not provided in the request
    echo json_encode(array('error' => 'User ID not provided'));
}

// Close connection
$conn->close();
?>
