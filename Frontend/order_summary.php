<?php
session_start();
if (isset($_SESSION['selected_movie_id']) && isset($_SESSION['selected_movie_title'])) {
    $selected_movie_id = $_SESSION['selected_movie_id'];
    $selected_movie_title = $_SESSION['selected_movie_title'];
   
} else {
    echo "Movie details not found.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,700;1,300;1,900&family=Lilita+One&display=swap" rel="stylesheet">
    <style>

        body {
       font-family: 'Poppins', sans-serif;
          background-color: black;
          text-align:center;
          text-color:pink;
   }
.navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: -20px;
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
    h1{
    margin-top:20px;
    text-align:center;
    color:yellow;
    }
            .orderbox {
                display: grid;
                width: 1000px;
                height: 630px;
                background-color: lightblue;
                margin-left: auto;
                margin-right: auto;
                border-radius: 10px;
                margin-top: 100px;
                grid-template-columns: 1fr 1fr;
                text-align: center;
                align-items: center;
                justify-content: center;
                padding: 50px;
            }
    .total-box {
        background-color: #F4893D;
        color: white;
        padding: 10px;
        border-radius: 25px;
        text-align: center;
        margin-top: 20px;
        height:18 px;
    }
            .orderdetails {
                padding-top: 20px;
                background-color: white;
                height: 500px;
                width: 400px;
                margin-bottom: 300px;
                border-radius: 10px;
            }

            .orderbox p {
                font-size: 14pt;
            }

      .quantity-container {
       display: flex;
       align-items: center;
       margin-left: 95px;
   }

   .button-container img {
       margin-right: 5px; /* Adjust the margin as needed */
   }


            .rightbox {
                display: grid;
                grid-template-rows: 1fr 1fr 1fr;
                justify-content: center;
            }

            .rightbox label {
                padding: 20px;
            }

            .continuecancelbuttons{
                display: grid;
                grid-template-columns: 1fr 1fr;
                height:40px;
                margin-top: 50px;
                margin-right:40 px;
            }

            a {
                text-decoration: black;
                color: black;
            }

    </style>
</head>
<body>

<div class="navbar">
    <h1>MOVIELANE</h1>
    
</div>
<h1>ORDER SUMMARY</h1>
<h2>Your session will expire in <span id="countdown">15:00</span>. Please checkout within this time to reserve your seats!.</h2> 
<script src="session-timer.js"></script>
<div class="orderbox">
    <div class="orderdetails">
        <p style="display:inline-block"><b>Order Details:</b></p>
        <br>
        <p>Movie: <?php echo $selected_movie_title; ?></p>
        <p>Date/Time: <span id="selectedDate"></span> <span id="selectedTime"></span></p>
        <p id="selectedShowroom"></p>
        <div id="selected-seats-info">
        
    </div>
        
                <span id="numTicketsChild" ></span><br/>
                <span id="numTicketsAdult" ></span><br/>
                <span id="numTicketsSenior" ></span><br/><br/>
           
                <p id="subtotal"></p>
        <br>
        <p>Sales Tax - <span id="salesTax"></span></p>
<p>Online Booking Fees - <span id="bookingFee"></span></p>
<div class="total-box">
    <p id="totalAmount"></p>
</div>


    </div>
    <div class="rightbox">
        <button style="background-color: white; width: 150px;height: 40px;border-radius: 5px; text-align:justify-center;"><a href="">Update Order</a></button>

        <div class="continuecancelbuttons">
            <button style="background-color: white; width: 150px;height: 40px;border-radius: 5px;"><a href="">Cancel</a></button>
            <?php
        // Check if the user is logged in
        if (isset($_SESSION['user_id'])) {
            // User is logged in, redirect to checkout page
            echo '<button style="background-color: white; width: 200px; height: 40px; border-radius: 5px;">
                    <a href="/checkout.php" style="display: center; width: 150px; height: 40px; color: black;">
                        Continue to Checkout
                    </a>
                  </button>';
        } else {
            // User is not logged in, redirect to login page
            echo '<button style="background-color: white; width: 200px; height: 40px; border-radius: 5px;">
                    <a href="/loginn.php" style="display: center; width: 150px; height: 40px; color: black;">
                    Continue to Checkout
                    </a>
                  </button>';
        }
        ?>
            </div>
    </div>
</div>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            // Retrieve selected seat values from session storage
            const selectedSeatValues = JSON.parse(sessionStorage.getItem('selectedSeatValues')) || [];

            // Get the selected seats info div
            const selectedSeatsInfoDiv = document.getElementById('selected-seats-info');

            // Create a paragraph element to display the selected seats
            const selectedSeatsParagraph = document.createElement('p');

            // Set the text content of the paragraph to display the selected seats
            selectedSeatsParagraph.textContent = 'Seats: ' + selectedSeatValues.join(' ');

            // Append the paragraph element to the selected seats info div
            selectedSeatsInfoDiv.appendChild(selectedSeatsParagraph);
        });
    </script>
<script>
var selectedDate = sessionStorage.getItem('selectedDate');
        var selectedTime = sessionStorage.getItem('selectedTime');

        // Update the HTML with retrieved date and time
        document.getElementById('selectedDate').innerText = selectedDate;
        document.getElementById('selectedTime').innerText = selectedTime;
        var selectedShowroom = sessionStorage.getItem('selectedShowroom');

        // Get the element where you want to display the selected showroom
        var selectedShowroomElement = document.getElementById('selectedShowroom');

        // Check if selectedShowroom is not null (i.e., it has been selected)
        if (selectedShowroom) {
            // Display the selected showroom
            selectedShowroomElement.textContent = " " + selectedShowroom;
        } else {
            // If no showroom is selected, display a message
            selectedShowroomElement.textContent = "Showroom not selected";
        }
     var numTicketsChild = sessionStorage.getItem('numTicketsChild');
    var numTicketsAdult = sessionStorage.getItem('numTicketsAdult');
    var numTicketsSenior = sessionStorage.getItem('numTicketsSenior');
    
    fetch('get_prices.php')
        .then(response => response.json())
        .then(data => {
            // Parse prices into numbers
            var childPrice = parseFloat(data.childPrice);
            var adultPrice = parseFloat(data.adultPrice);
            var seniorPrice = parseFloat(data.seniorPrice);
            var salesTax = parseFloat(data.salesTax);
            var bookingFee = parseFloat(data.bookingFee);

            // Calculate subtotal
            var subtotal = childPrice * numTicketsChild + adultPrice * numTicketsAdult + seniorPrice * numTicketsSenior;

            // Calculate total amount
            var totalAmount = subtotal + salesTax + bookingFee;

            // Output the quantity and total price for each ticket type
            document.getElementById('numTicketsChild').innerText = "Child x " + numTicketsChild + " - $" + (childPrice * numTicketsChild).toFixed(2);
            document.getElementById('numTicketsAdult').innerText = "Adult x " + numTicketsAdult + " - $" + (adultPrice * numTicketsAdult).toFixed(2);
            document.getElementById('numTicketsSenior').innerText = "Senior x " + numTicketsSenior + " - $" + (seniorPrice * numTicketsSenior).toFixed(2);
            document.getElementById('subtotal').innerText = "Subtotal - $" + subtotal.toFixed(2);
            document.getElementById('salesTax').innerText = " - $" + salesTax.toFixed(2);
            document.getElementById('bookingFee').innerText = "- $" + bookingFee.toFixed(2);

            // Display total amount
            document.getElementById('totalAmount').innerText = "Total - $" + totalAmount.toFixed(2);
            // Store totalAmount in session storage
sessionStorage.setItem('totalAmount', totalAmount.toFixed(2));


        })
    .catch(error => console.error('Error fetching prices:', error));
        </script>
</body>
        </html>