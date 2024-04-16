<?php
// Assuming you have already established a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "home"; // Change this to your actual database name

// Create connection
$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// Set the PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Function to fetch movie details based on selected movie title
function fetchMovieDetails($pdo, $movieTitle) {
    $stmt = $pdo->prepare("SELECT * FROM movies WHERE title = :movieTitle");
    $stmt->bindParam(':movieTitle', $movieTitle);
    $stmt->execute();
    $movieDetails = $stmt->fetch(PDO::FETCH_ASSOC);
    return $movieDetails;
}

if (isset($_GET['moviesDropdown'])) {
    $movieTitle = $_GET['moviesDropdown'];
    // Fetch movie details
    $movieDetails = fetchMovieDetails($pdo, $movieTitle);

    // Send movie details as JSON response
    echo json_encode($movieDetails);
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
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
    $duration = $_POST['duration'];

    // Prepare SQL statement
    $sql = "UPDATE movies SET category=:category, movieCast=:cast, director=:director, producer=:producer, synopsis=:synopsis, reviews=:reviews, picture=:trailerPicUrl, trailer=:trailerVideoUrl, ratingCode=:mpaaRating, comingSoon=:comingSoon, duration=:duration WHERE title=:movieTitle";
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':cast', $cast);
    $stmt->bindParam(':director', $director);
    $stmt->bindParam(':producer', $producer);
    $stmt->bindParam(':synopsis', $synopsis);
    $stmt->bindParam(':reviews', $reviews);
    $stmt->bindParam(':trailerPicUrl', $trailerPicUrl);
    $stmt->bindParam(':trailerVideoUrl', $trailerVideoUrl);
    $stmt->bindParam(':mpaaRating', $mpaaRating);
    $stmt->bindParam(':comingSoon', $comingSoon);
    $stmt->bindParam(':duration', $duration);
    $stmt->bindParam(':movieTitle', $movieTitle);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Movie details updated successfully";
    } else {
        echo "Error updating movie details: " . $stmt->errorInfo()[2];
    }
}

?>
