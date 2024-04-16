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

// Prepare SQL statement to fetch movie titles
$sql = "SELECT title FROM movies";
$result = $conn->query($sql);

$movieTitles = array();

if ($result->num_rows > 0) {
    // Fetch movie titles and store them in an array
    while ($row = $result->fetch_assoc()) {
        $movieTitles[] = $row['title'];
    }
}

// Close database connection
$conn->close();

// Return movie titles in JSON format
echo json_encode($movieTitles);
?>
