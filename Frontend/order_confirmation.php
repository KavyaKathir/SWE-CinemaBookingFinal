<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link href="https://fonts.googleapis.com/css2?family=Chewy&family=Comfortaa:wght@300&family=Pacifico&display=swap&family=Nunito&display=swap" rel="stylesheet">
    <style>
        .navbar {
    background-color: yellow;
    color: white;
    padding: 25px 25px;
    height:15px;
}

.navbar-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    margin: 0;
     font-size: 30px;
     color: red;
}

.nav-buttons button {
    background-color: transparent;
    justify-content: space-between;
    color: blue;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
     font-size: 25px;
}

.nav-buttons button:hover {
    background-color: orange;
}

        body {
            font-family: Nunito;
            border: 1px solid black;
            padding: 0em;
            margin: 0em;
            height: auto;
        }

        header{
            display: block;
            background-color:black;
            border: 1px solid black;
            padding: 0.5em;
        }

        header h5{
            text-align: center;
            color: white;
            font-size: 100%;
            font-family: Nunito;
            padding:0em;
            margin: 0em;
        }

        #mainlist{
            color:black;
            margin-top: 2em;
            border: none;
        }

        #sideicon {
            margin-top: 2em;
            border: none;
            float:right;
            margin-left:2em;
        }

        #search {
            margin-top: 2.7em;
            float:right;
            border: 1px solid lightgray;
            padding: 0.5em;
        }

        #searchbutton {
            margin-top: 2.7em;
            float:right;
            border: 1px solid lightgray;
            background-color: lightgray;
        }

        .menu {
            height: 65px;
            padding-left: 5em;
            padding-right: 5em;
            position: relative;
            z-index: 1;
        }

        #logo {
            max-width: 60px;
            padding: 1em;
            margin-right: 23em;
            float:left;
            height:auto;
        }

        #icon {
            max-width: 25px;
        }

        .menu ul{
            list-style: none;
            margin:0;
            padding:0;
        }

        .menu li{
            width:120px;
            margin:0;
            text-align:center;
            float: left;
        }

        .menu a {
            font-weight: 600;
            font-size: 100%;
            color:black;
            background-color: white;
            border: 2px solid black;
            display:block;
            padding:10px 0px 10px 0px;
            margin: 0px 0px 0px 0px;
        }

        .menu a:hover {
            background-color: #AFAFAF;
        }

        .one {
            position:relative;
        }

        .two {
            padding:0;
            margin:0;
            display: none;
            position:absolute;
        }

        .two li {
            clear:left;
        }

        .one li:hover .two {
            display:block;
        }

        a:link{
            text-decoration: none;
        }

        main{
            height: auto;
            border: 1px solid black;
            padding-top:0;
            padding-bottom: 2em;
            background-color:black;
        }

        img {
            width: 300px;
            border-radius: 50px;
        }

        #userdetails {
            padding: 2em;
            text-align:center;
            color: white;
        }

        h1 {
            margin-bottom: 1em;
        }

        h3 {
            margin: 10px;
            margin-bottom: 1em;
        }

        #profilebutton {
            color: black;
            background-color: white;
            font-family: Nunito;
            border-radius: 50px;
            padding: 7px;
            font-size: 1.4em;
            padding-left: 2em;
            padding-right: 2em;
        }

        #history-button {
            color: black;
            background-color: white;
            font-family: Nunito;
            border-radius: 50px;
            padding: 7px;
            font-size: 1.4em;
            padding-left: 1.5em;
            padding-right: 1.5em;
        }
        #view-history-button {
            color: black;
            background-color: white;
            font-family: Nunito;
            border-radius: 50px;
            padding: 7px;
            font-size: 1.4em;
            padding-left: 1.5em;
            padding-right: 1.5em;
        }
        #view-history-button.hover {
        color:red;
        }
        p {
            text-align: center;
            margin-top:5px;
        }

        footer{
            display:block;
            border: 1px solid black;
            padding-top:10px;
            background-color:black;
        }

        span{
            color:white;
            font-size: 13px;
        }
        .profile-icon {
            background-color: transparent;
            margin-right: 90px;
            border: none;
            cursor: pointer;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            z-index: 1;
        }
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
        .profile-dropdown:hover .dropdown-content {
            display: block;
        }
        .button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
}

.button:hover {
    background-color: #45a049;
}

    </style>
</head>
<body>
<div class="navbar">
    <div class="navbar-container">
        <div class="logo-container"><h1 class="logo">MOVIELANE </h1></div>
        <div class="nav-buttons">
       <?php if (isset($_SESSION['user_id'])) {
            // If logged in, display the profile icon with dropdown menu
            echo '<div class="profile-dropdown">';
            echo '<button class="profile-icon"><i class="fas fa-user"></i></button>';
            echo '<div class="dropdown-content">';
            echo '<a href="/editProfile.php"><i class="fas fa-user-edit"></i> Edit Profile</a>';
            echo '<a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>';
            echo '</div>';
            echo '</div>';
        }
?>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<header>
    <h5>CONFIRMATION PAGE</h5>
</header>
<main>
    
    <div id="userdetails">
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "home";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Fetch user details
            $userID = $_SESSION['user_id'];
            $stmt = $conn->prepare("SELECT firstName,email FROM users WHERE userID = :userID");
            $stmt->bindParam(':userID', $userID);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt = $conn->prepare("SELECT bookingID FROM booking WHERE userID = :userID");
            $stmt->bindParam(':userID', $userID);
            $stmt->execute();
            $bookingID = $stmt->fetchColumn();
        
            // Fetch booking details
            $stmt = $conn->prepare("SELECT * FROM booking WHERE bookingID = :bookingID");
            $stmt->bindParam(':bookingID', $bookingID);
            $stmt->execute();
            $booking = $stmt->fetch(PDO::FETCH_ASSOC);
        
            // Fetch selected seats
            $stmt = $conn->prepare("SELECT seatNumber FROM seat WHERE bookingID = :bookingID");
            $stmt->bindParam(':bookingID', $bookingID);
            $stmt->execute();
            $selectedSeats = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
            // Fetch movie title
            $movieID = $booking['movieID'];
            $stmt = $conn->prepare("SELECT title FROM movies WHERE id = :movieID");
            $stmt->bindParam(':movieID', $movieID);
            $stmt->execute();
            $movie = $stmt->fetch(PDO::FETCH_ASSOC);
            // Display the retrieved information
            echo "<h1>Thank you {$user['firstName']}, for booking with us</h1>";
            echo "<h3>Your Booking confirmation number is {$booking['bookingNumber']}</h3>";
echo "<span id='selectedShowroom'>Booked in Showroom: </span>";
echo "<h3>Movie Title: {$movie['title']}</h3>";
echo "<p>Date/Time: <span id='selectedDate'></span> <span id='selectedTime'></span></p>";
            echo "<h3>Seats: " . implode(", ", $selectedSeats) . "</h3>";
            echo "<h3>Total Price: {$booking['totalPrice']}</h3>";
            echo "<h3>A copy of your ticket is sent to {$user['email']}</h3>";
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
        <a href="homepage.php" class="button">Home</a>
<a href="order_history.php" class="button">View Ticket History</a>

    </div>
</main>
<script>
var selectedShowroom = sessionStorage.getItem('selectedShowroom');
document.getElementById("selectedShowroom").textContent = selectedShowroom;
var selectedDate = sessionStorage.getItem('selectedDate');
        var selectedTime = sessionStorage.getItem('selectedTime');

        // Update the HTML with retrieved date and time
        document.getElementById('selectedDate').innerText = selectedDate;
        document.getElementById('selectedTime').innerText = selectedTime;
    </script>
<footer>
    <p>&copy; 2024 Your Company</p>
</footer>
</body>

</html>
