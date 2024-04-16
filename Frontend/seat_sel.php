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
    <title>Select ticket</title>
    <style>
        body {
          margin: 0;
          padding: 0;
          font-family: Arial, sans-serif;
          overflow: hidden;
          background: linear-gradient(45deg, #ffcc00, #ff6600, #ff3300, #ff6600, #ffcc00);
          background-size: 400% 400%;
          animation: gradientAnimation 10s ease infinite;
        }

        @keyframes gradientAnimation {
          0% {
            background-position: 0% 50%;
          }
          50% {
            background-position: 100% 50%;
          }
          100% {
            background-position: 0% 50%;
          }
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: -5px;
            background-color: #333;
            color: white;
        }

        .navbar p {
            margin: 0;
        }

        .navbar-links {
            display: flex;
        }

        .navbar-links a {
            margin-right: 10px;
            color: white;
            text-decoration: none;
        }

        .navbar-links a:last-child {
            margin-right: 0;
        }

        .ticket-form {
          background-color: rgba(255, 255, 255, 0.8);
          border-radius: 5px;
          padding: 20px;
          margin: 20px auto;
          max-width: 400px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .ticket-price {
          text-align: center;
          font-size: 16px;
          margin-bottom: 10px;
        }

       
        .nav-buttons button:hover {
            background-color: red;
        }
    </style>
</head>
<body>

<div class="navbar">
    <h1>MOVIELANE</h1>
    
</div>

<div id="remaining-seats">
    <p >Seats Remaining: <span id="seats-remaining"></span></p>
</div>


<div class="ticket-form">
<?php
    // Database connection
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
