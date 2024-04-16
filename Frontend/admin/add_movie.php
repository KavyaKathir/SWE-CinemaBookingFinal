<?php
// Establish database connection
if(isset($_POST['submit'])) {
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

// Fetch movie data from POST request
$movieTitle = $_POST['movieTitle'];
$category = $_POST['category'];
$cast = $_POST['cast'];
$director = $_POST['director'];
$producer = $_POST['producer'];
$synopsis = $_POST['synopsis'];
$reviews = $_POST['reviews'];
$trailerPicUrl = $_POST['trailerPicUrl'];
$trailerVideoUrl = $_POST['trailerVideoUrl'];
$mpaaRating = $_POST['mpaaRating'];
$comingSoon = $_POST['comingSoon'];
$duration=$_POST['duration'];
// Prepare SQL statement
$sql = "INSERT INTO movies (title, category, movieCast, director, producer, synopsis, reviews, trailer, picture, ratingCode, comingSoon,duration)
        VALUES ('$movieTitle', '$category', '$cast', '$director', '$producer', '$synopsis', '$reviews', '$trailerVideoUrl', '$trailerPicUrl', '$mpaaRating', '$comingSoon','$duration')";

if ($conn->query($sql) === TRUE) {
    echo "new movie inserted successfully";
    header('Location: schedulemovies.html');
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close database connection
$conn->close();
}
?>
