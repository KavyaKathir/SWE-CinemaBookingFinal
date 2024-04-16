<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "home";

// Establish database connection
$dbConnection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($dbConnection->connect_error) {
    die("Connection failed: " . $dbConnection->connect_error);
}

// Check if the request is for deleting a movie
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["movieTitle"])) {
    // Get selected movie title from POST request
    $selectedMovie = $_POST['movieTitle'];

    // Perform deletion operation in the database
    $sql = "DELETE FROM movies WHERE title = ?";
    $stmt = $dbConnection->prepare($sql);
    $stmt->bind_param("s", $selectedMovie);
    $stmt->execute();

    // Check if deletion was successful
    if ($stmt->affected_rows > 0) {
        echo "Movie deleted successfully";
    } else {
        echo "Error deleting movie";
    }

    // Close statement
    $stmt->close();
} else { // If the request is for selecting movies
    // Perform query to fetch movie titles
    $sql = "SELECT title FROM movies";
    $result = $dbConnection->query($sql);

    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Output data of each row
        $movies = array();
        while ($row = $result->fetch_assoc()) {
            $movies[] = $row["title"];
        }
    } else {
        echo "0 results";
    }

    // Close database connection
    $dbConnection->close();

    // Output JSON encoded array of movie titles
    echo json_encode($movies);
}
?>
