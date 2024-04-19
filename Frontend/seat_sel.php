<?php
session_start();
if (isset($_SESSION['selected_movie_id']) && isset($_SESSION['selected_movie_title'])) {
    $selected_movie_id = $_SESSION['selected_movie_id'];
    $selected_movie_title = $_SESSION['selected_movie_title'];
    echo "You selected Movie ID: " . $selected_movie_id . ", Title: " . $selected_movie_title;
} else {
    echo "Movie details not found.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Ticket</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #FFE4E1; /* Light Pink background */
            color: #333333; /* Dark text for contrast */
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: #000000; /* black background for navbar */
            color: #333333;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        }

        .navbar h1 {
            margin: 0;
            font-size: 30px; /* Adjusted font size */
            color: #fff; 
        }

        .navbar-links {
            display: flex;
        }

        .navbar-links a {
            margin-right: 10px;
            color: #333333;
            text-decoration: none;
        }

        .navbar-links a:last-child {
            margin-right: 0;
        }

        .ticket-form {
            background-color: #ffffff; /* White background for form */
            border-radius: 5px;
            padding: 40px;
            margin: 20px auto;
            max-width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .ticket-price {
            text-align: center;
            font-size: 20px;
            margin-bottom: 10px;
        }

        /* Additional styles */
        .ticket-form input[type="number"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            width: calc(100% - 22px); /* Full width minus padding and border */
            font-size: 20px;
        }

        .ticket-form .new-button {
            padding: 5px 20px;
            background-color: #ff1493; /* Pink color for button */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%; /* Full width button */
            box-sizing: border-box; /* Include padding in width calculation */
            margin-top: 10px;
        }

        .ticket-form .new-button:hover {
            background-color: #ff69b4; /* Darker pink on hover */
        }

        /* Update Seats Remaining section */
        #remaining-seats {
            text-align: center;
            padding: 10px;
            font-size: 25px;
            color: #333333;
            margin-top: 10px;
        }

    </style>
</head>
<body>

<!-- Content goes here -->

</body>
</html>

<body>

<div class="navbar">
    <!-- Wrap the h1 element with an anchor tag -->
    <a href="homepage.php" style="color: white; text-decoration: none;">
        <h1>MOVIELANE</h1>
    </a>
</div>


<div id="remaining-seats">
    <p >Seats Remaining: <span id="seats-remaining"></span></p>
</div>


<div class="ticket-form">
<?php
    // Database connection
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "home";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch prices from database
    $sql = "SELECT * FROM prices";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<div class="ticket-price">
                    <p>Child Ticket Price: $' . $row["childPrice"] . '</p>
                </div>';
            echo '<label for="age-category-child">Number of Tickets - Child:</label>
                  <input type="number" id="num-tickets-child" min="0" ><br>';

            echo '<div class="ticket-price">
                    <p>Adult Ticket Price: $' . $row["adultPrice"] . '</p>
                </div>';
            echo '<label for="age-category-adult">Number of Tickets - Adult:</label>
                  <input type="number" id="num-tickets-adult" min="0" ><br>';

            echo '<div class="ticket-price">
                    <p>Senior Ticket Price: $' . $row["seniorPrice"] . '</p>
                </div>';
            echo '<label for="age-category-senior">Number of Tickets - Senior:</label>
                  <input type="number" id="num-tickets-senior" min="0" ><br>';
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>

    <a href="./seat_map.php" class="new-button">Next</a>
</div>



<script>

    document.addEventListener("DOMContentLoaded", function() {
      updateRemainingSeats();
     
    });

    function updateRemainingSeats() {
  var totalSeats = 40; 
  var numTicketsChild = parseInt(document.getElementById("num-tickets-child").value) || 0;
  var numTicketsAdult = parseInt(document.getElementById("num-tickets-adult").value) || 0;
  var numTicketsSenior = parseInt(document.getElementById("num-tickets-senior").value) || 0;
  var totalTickets = numTicketsChild + numTicketsAdult + numTicketsSenior;
  var seatsRemaining = totalSeats - totalTickets;

  document.getElementById("seats-remaining").textContent = seatsRemaining;
  
  sessionStorage.setItem('selectedSeats', totalTickets);
  sessionStorage.setItem('seatsRemaining', seatsRemaining); 
  sessionStorage.setItem('numTicketsChild', numTicketsChild);
  sessionStorage.setItem('numTicketsAdult', numTicketsAdult);
  sessionStorage.setItem('numTicketsSenior', numTicketsSenior);   
}

document.getElementById("num-tickets-child").addEventListener("input", function() {
      updateRemainingSeats();
    });
    document.getElementById("num-tickets-adult").addEventListener("input", function() {
      updateRemainingSeats();
    });

    document.getElementById("num-tickets-senior").addEventListener("input", function() {
      updateRemainingSeats();
    });
   
</script>

</body>
</html>
