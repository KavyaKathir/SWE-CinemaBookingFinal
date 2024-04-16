<?php
// Database connection parameters
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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the form
    $movieTitle = $_POST['movieTitleu']; // Assuming you have a name attribute in your movie dropdown
    $date = $_POST['deleteDate'];
    $time = $_POST['deleteTime'];

    // Retrieve movie ID based on movie title
    $movieQuery = "SELECT id FROM movies WHERE title = '$movieTitle'";
    $movieResult = mysqli_query($conn, $movieQuery);

    if ($movieResult) {
        $movieRow = mysqli_fetch_assoc($movieResult);
        $movieID = $movieRow['id'];

        // Delete the schedule entry from the `show` table
        $deleteQuery = "DELETE FROM `show` WHERE `movieID` = '$movieID' AND `date` = '$date' AND `time` = '$time'";
        if ($conn->query($deleteQuery) === TRUE) {
            header("Location: manageschedules.php");
            exit;
        } else {
            echo "Error deleting schedule: " . $conn->error;
        }
    } else {
        echo "Error retrieving movie ID: " . mysqli_error($conn);
    }
}

// Close connection
$conn->close();
?>
