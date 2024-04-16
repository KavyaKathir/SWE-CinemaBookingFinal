<?php
session_start();
if (isset($_SESSION['selected_movie_id']) && isset($_SESSION['selected_movie_title'])) {
    $selected_movie_id = $_SESSION['selected_movie_id'];
    $selected_movie_title = $_SESSION['selected_movie_title'];
   
} else {
    echo "Movie details not found.";
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "home";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $userID = $_SESSION['user_id'];
    $stmt1 = $conn->prepare("SELECT * FROM payment_card WHERE userID = :userID");
    $stmt1->bindParam(':userID', $userID);
    $stmt1->execute();
    $savedCards = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    $stmt_optin = $conn->prepare("SELECT optInPromo FROM users WHERE userID = :userID");
    $stmt_optin->bindParam(':userID', $userID);
    $stmt_optin->execute();
    $optinpromo = $stmt_optin->fetchColumn();
    
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Validate and sanitize form input data (you can add more validation as needed)
$selectedSeatValues = json_decode($_POST['selectedSeatValues']);
$paymentOption = $_POST['paymentOption'];
$totalPrice = $_COOKIE['orderTotal'];
        echo $totalPrice; // Assuming you have stored the total price in the session
        $bookingNumber = uniqid(); // Generate a unique booking number
        $userID = $_SESSION['user_id']; // Assuming userID is stored in the session
        $movieID = $selected_movie_id; // Use the selected movie ID from the session
        $selectedDate = $_POST['selectedDate'];
    
        // Now you can use $selectedDate variable in your PHP code
        echo "Selected date: " . $selectedDate;
        $selectedTime=$_POST['selectedTime'];        // If payment is done using a saved card
        if ($paymentOption === "savedCard") {
            // Retrieve the paymentID associated with the saved card from the payment_card table
            $selectedSavedCard = $_POST['savedCard']; // Assuming the selectedSavedCard is the last 4 digits of the card number
            $stmt = $conn->prepare("SELECT paymentCardID FROM payment_card WHERE cardNumber LIKE CONCAT('%', :selectedSavedCard)");
            $stmt->bindParam(':selectedSavedCard', $selectedSavedCard);
            $stmt->execute();
            $paymentID = $stmt->fetchColumn();
        } else {
             // If payment is done using a new card
            $cardNumber = $_POST['cardNumber1'];
$billingStreet = $_POST['billingStreet1'];
$billingCity = $_POST['billingCity1'];
$billingState = $_POST['billingState1'];
$billingCountry = $_POST['billingCountry1'];
$billingZipCode = $_POST['billingZipCode1'];
$expirationDate = $_POST['expirationDate1'];
if (isset($_POST['cardType']) && $_POST['cardType'] == 'credit') {
    $cardType = 'credit';
} elseif (isset($_POST['cardType']) && $_POST['cardType'] == 'debit') {
    $cardType = 'debit';
} else {
    // Default to empty string or handle the case when no radio button is selected
    $cardType = ''; // You can set a default value or handle this case based on your requirements
}
 

// Insert new card payment details into the database
$stmt = $conn->prepare("INSERT INTO payment_card (cardNumber, billingStreet, billingCity, billingState, billingCountry, billingZipCode, expirationDate, cardType, userID) VALUES (:cardNumber, :billingStreet, :billingCity, :billingState, :billingCountry, :billingZipCode, :expirationDate, :cardType, :userID)");
$stmt->bindParam(':cardNumber', $cardNumber);
$stmt->bindParam(':billingStreet', $billingStreet);
$stmt->bindParam(':billingCity', $billingCity);
$stmt->bindParam(':billingState', $billingState);
$stmt->bindParam(':billingCountry', $billingCountry);
$stmt->bindParam(':billingZipCode', $billingZipCode);
$stmt->bindParam(':expirationDate', $expirationDate);
$stmt->bindParam(':cardType', $cardType);
$stmt->bindParam(':userID', $userID);
$stmt->execute();
            $paymentID = $conn->lastInsertId();
        }
$promotionID=5;
        // Insert new booking details into the database
        $stmt = $conn->prepare("INSERT INTO booking (totalPrice, bookingNumber, bookingStatus, userID, movieID,promotionID,paymentID) VALUES (:totalPrice, :bookingNumber,'Confirmed', :userID, :movieID,:promotionID,:paymentID)");
        $stmt->bindParam(':totalPrice', $totalPrice);
        $stmt->bindParam(':bookingNumber', $bookingNumber);
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':movieID', $movieID);
        $stmt->bindParam(':promotionID', $promotionID);
        $stmt->bindParam(':paymentID', $paymentID);
        $stmt->execute();
        $bookingID = $conn->lastInsertId();

        // Insert new showtime details into the database
        $stmt_showtime = $conn->prepare("INSERT INTO showtime (showDate, showTime, bookingID) VALUES (:showDate, :showTime, :bookingID)");
        $stmt_showtime->bindParam(':showDate', $selectedDate);
        $stmt_showtime->bindParam(':showTime', $selectedTime);
        $stmt_showtime->bindParam(':bookingID', $bookingID);
        $stmt_showtime->execute();
        // Retrieve the number of tickets for each type from the form submission
$numTicketsChild = $_POST['numTicketsChild'];
$numTicketsAdult = $_POST['numTicketsAdult'];
$numTicketsSenior = $_POST['numTicketsSenior'];

// Insert ticket data into the ticket table
$stmt = $conn->prepare("INSERT INTO ticket (ticketNumber, ticketType, bookingID) VALUES (:ticketNumber, :ticketType, :bookingID)");
if ($numTicketsChild > 0) {
// Insert child tickets
for ($i = 0; $i < $numTicketsChild; $i++) {
    $stmt->bindParam(':ticketNumber', $numTicketsChild);
    $stmt->bindValue(':ticketType', 'ChildTicket');
    $stmt->bindParam(':bookingID', $bookingID);
    $stmt->execute();
}
}
if ($numTicketsAdult > 0) {
// Insert adult tickets
for ($i = 0; $i < $numTicketsAdult; $i++) {
    $stmt->bindParam(':ticketNumber', $numTicketsAdult);
    $stmt->bindValue(':ticketType', 'AdultTicket');
    $stmt->bindParam(':bookingID', $bookingID);
    $stmt->execute();
}
}
if ($numTicketsSenior > 0) {
// Insert senior tickets
for ($i = 0; $i < $numTicketsSenior; $i++) {
    $stmt->bindParam(':ticketNumber', $numTicketsSenior);
    $stmt->bindValue(':ticketType', 'SeniorTicket');
    $stmt->bindParam(':bookingID', $bookingID);
    $stmt->execute();
}
}
$stmt = $conn->prepare("INSERT INTO seat (seatNumber,bookingID) VALUES (:seatNumber,:bookingID)");

        // Insert each seat value into the database
        foreach ($selectedSeatValues as $seatNumber) {
            // Bind the parameter and execute the statement
            $stmt->bindParam(':seatNumber', $seatNumber);
            $stmt->bindParam(':bookingID', $bookingID);
            $stmt->execute();
        }
        
        // Fetch user details
        $userID = $_SESSION['user_id'];
        $stmt = $conn->prepare("SELECT firstName, email FROM users WHERE userID = :userID");
        $stmt->bindParam(':userID', $userID);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Fetch booking details
        $stmt = $conn->prepare("SELECT * FROM booking WHERE userID = :userID");
        $stmt->bindParam(':userID', $userID);
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
        
        // Compose the email message
        $subject = "Confirmation Email for your booking";
        $message = "Hi {$user['firstName']},\n\n";
        $message .= "Thank you for booking with us!\n\n";
        $message .= "Your Booking confirmation number is: {$booking['bookingNumber']}\n";
        $message .= "Movie Title: {$movie['title']}\n";
        $message .= "Date/Time: {$selectedDate} {$selectedTime}\n";
        $message .= "Seats: " . implode(", ", $selectedSeats) . "\n";
        $message .= "Total Price: {$booking['totalPrice']}\n";
        $message .= "Thank you,\nMOVIELANE Accounts Team";
        
        $sender = "From: MOVIELANE BOOKING"; // Change this to your email address
        
        // Send the email
        if (mail($user['email'], $subject, $message, $sender)) {
            echo "Email sent successfully!";
        } else {
            echo "Failed to send email!";
        }
        
        
        // Redirect to the order confirmation page
        header("Location: /Frontend/order_confirmation.php");
        exit();
    }}
catch(PDOException $e) {
echo "Connection failed: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, #7F7FD5, #86A8E7, #91EAE4);
            background-size: 600% 600%;
            animation: gradientBG 10s ease infinite;
             padding-top: 50px;
        }

        @keyframes gradientBG {
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
nav {
    background-color: #333;
    padding: 10px 20px;
    display: flex;
    align-items: center; /* Center items vertically */
    position: fixed;
    top: 0;
    height: 50px;
    width: 100%;
    z-index: 2;
}


.logo {
    color: white; /* Set the color of the text */
    font-size: 24px; /* Set the font size of the text */
    line-height: 50px; /* Match line height to the height of the logo */
    margin-left: 10px; /* Add some left margin for spacing */
}

.payment-container,
.promo-container {

    margin: 10px;
}
       .payment-container {
    padding: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-top: 100px;
    margin-bottom: 100px;
 max-width: 100%; /* Adjust this value as needed */
    width: 1200px;;
    box-sizing: border-box;


    z-index: 0;
}

        .promo-container {
            flex: 1;
            padding: 20px;
            background-color:  white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 10px;
            max-width: 300px;

        }

        .payment-container h2,
        .promo-container h2 {
            margin-top: 0;
            color: #333;
        }

        .payment-container label,
        .promo-container label {
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }

        .payment-container input[type="text"],
        .payment-container select,
        .promo-container input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .payment-container input[type="submit"],
        .promo-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #b013b0d6;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .payment-container input[type="submit"]:hover,
        .promo-container input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
    
</head>
<body>

<nav>
    <img src="./Frontend/img/lo.png" style="width:50px; height:50px;">
    <h1 class="logo">MOVIELANE </h1>
</nav>

<form method="post" >
    
<div class="payment-container">
<h2>Your session will expire in <span id="countdown">15:00</span>. Please checkout within this time to reserve your seats!.</h2> 
<script src="/Frontend/session-timer.js"></script>
<h2>Payment </h2>
    <label><input type="radio" id="savedCardOption" name="paymentOption" value="savedCard"> Pay with saved card</label>
    <br>
    <label><input type="radio" id="newCardOption" name="paymentOption" value="newCard"> Pay with new card</label>
    <br>
    <div id="savedCardDetails" style="display: none;">
        <h3>Saved Card</h3>
        <label for="savedCard">Select a card:</label>
        <select id="savedCard" name="savedCard">
                <option value="">Select a card</option>
                <?php foreach ($savedCards as $card) { ?>
                    <option value="<?php echo substr($card['cardNumber'], -4); ?>"><?php echo $card['cardType'] . ' - **** **** **** ' . substr($card['cardNumber'], -4); ?></option>
                <?php } ?>
            </select>

            <!-- Hidden fields to store saved card details -->
            <input type="hidden" id="savedCardType" value="">
            <input type="hidden" id="savedCardNumber" value="">
            <input type="hidden" id="savedExpirationDate" value="">
            <input type="hidden" id="savedBillingStreet" value="">
            <input type="hidden" id="savedBillingCity" value="">
            <input type="hidden" id="savedBillingState" value="">
            <input type="hidden" id="savedBillingCountry" value="">
            <input type="hidden" id="savedBillingZipCode" value="">

            <!-- Script to populate fields when a saved card is selected -->
            <script>
                document.getElementById('savedCard').addEventListener('change', function() {
                    var selectedCard = this.value;
                    var cards = <?php echo json_encode($savedCards); ?>;
                    var selectedCardDetails = cards.find(function(card) {
                        return card.cardNumber.endsWith(selectedCard);
                    });

                    if (selectedCardDetails) {
                        document.getElementById('savedCardType').value = selectedCardDetails.cardType;
                        document.getElementById('savedCardNumber').value = selectedCardDetails.cardNumber;
                        document.getElementById('savedExpirationDate').value = selectedCardDetails.expirationDate;
                        document.getElementById('savedBillingStreet').value = selectedCardDetails.billingStreet;
                        document.getElementById('savedBillingCity').value = selectedCardDetails.billingCity;
                        document.getElementById('savedBillingState').value = selectedCardDetails.billingState;
                        document.getElementById('savedBillingCountry').value = selectedCardDetails.billingCountry;
                        document.getElementById('savedBillingZipCode').value = selectedCardDetails.billingZipCode;
                    }
                });
            </script>

    </div>
    <input type="hidden" id="selectedDate" name="selectedDate">
    <input type="hidden" id="selectedTime" name="selectedTime">
    
<input type="hidden" id="numTicketsChild" name="numTicketsChild" min="0">
<br>

<input type="hidden" id="numTicketsAdult" name="numTicketsAdult" min="0">
<br>

<input type="hidden" id="numTicketsSenior" name="numTicketsSenior" min="0">
<input type="hidden" name="selectedSeatValues" id="selectedSeatValues" value="">

<br>

    <div id="newCardDetails" style="display: none;">
        <h3>New Card</h3>
        <label>Card Type:</label>
        <label><input type="radio" name="cardType" value="credit"> Credit</label>
<label><input type="radio" name="cardType" value="debit"> Debit</label>

        <br>
        <label for="cardNumber1">Card Numbr:</label>
        <input type="text" id="cardNumber1" name="cardNumber1" placeholder="1234567890121234">
        <br>
        <label for="expirationDate1">Expiration Date:</label>
        <input type="text" id="expirationDate1" name="expirationDate1" placeholder="12/24">
        <br>
        <label for="billingStreet1">Billing Street:</label>
        <input type="text" id="billingStreet1" name="billingStreet1" placeholder="123 Main St">
        <br>
        <label for="billingCity1">Billing City:</label>
        <input type="text" id="billingCity1" name="billingCity1" placeholder="Anytown">
        <br>
        <label for="billingState1">Billing State:</label>
        <input type="text" id="billingState1" name="billingState1" placeholder="CA">
        <br>
        <label for="billingCountry1">Billing Country:</label>
        <input type="text" id="billingCountry1" name="billingCountry1" placeholder="USA">
        <br>
        <label for="billingZipCode1">Billing Zip Code:</label>
        <input type="text" id="billingZipCode1" name="billingZipCode1" placeholder="12345">
        <br>
    </div>
    <input type="submit" value="Checkout">
</div>
</form>
<div class="promo-container">
    <h2>Order Total:</h2>
    <p id="orderTotal">$43.76</p>
    <?php if ($optinpromo == 1) { ?>
    <h2>Promotion Code</h2>
    <label for="promoCode">Enter your promotion code:</label>
    <input type="text" id="promoCode" name="promoCode" placeholder="Enter promo code">
    <br>
    <input type="submit" id="promoapply" name="promoapply" value="Apply Promo">
    <?php } ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const savedCardOption = document.getElementById('savedCardOption');
        const newCardOption = document.getElementById('newCardOption');
        const savedCardDetails = document.getElementById('savedCardDetails');
        const newCardDetails = document.getElementById('newCardDetails');

        savedCardOption.addEventListener('change', function() {
            savedCardDetails.style.display = 'block';
            newCardDetails.style.display = 'none';
        });

       
        document.getElementById('savedCard').addEventListener('change', function() {
            const selectedCard = this.value;
            if (selectedCard) {
                document.getElementById('savedCardFields').style.display = 'block';
            } else {
                document.getElementById('savedCardFields').style.display = 'none';
            }
        });
        newCardOption.addEventListener('change', function() {
        const savedCardCount = <?php echo count($savedCards); ?>;
        if (savedCardCount >= 3) {
            alert("You already have 3 saved cards. Please select 'Pay with saved card'");
            // Revert the selection to "Pay with saved card"
            savedCardOption.checked = true;
            savedCardDetails.style.display = 'block';
            newCardDetails.style.display = 'none';
        } else {
            newCardDetails.style.display = 'block';
            savedCardDetails.style.display = 'none';
        }
    });
        var totalAmount = parseFloat(sessionStorage.getItem('totalAmount'));

// Update the order total in the HTML
if (!isNaN(totalAmount)) {
    document.getElementById('orderTotal').innerText = " $" + totalAmount.toFixed(2);
} else {
    // Handle the case where totalAmount is not available
    document.getElementById('orderTotal').innerText = "Total - N/A";
}
    document.getElementById('promoapply').addEventListener('click', function() {
                const promoCode = document.getElementById('promoCode').value;
                // Make sure promoCode is not empty
                if (promoCode.trim() !== '') {
                    // Make AJAX request to check promo code
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', 'check_promo_code.php');
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            const discountPercent = parseInt(xhr.responseText);
                            orderTotal= totalAmount.toFixed(2);// Assuming order total is hardcoded here, you can dynamically fetch it from your backend
                            if (discountPercent > 0 && discountPercent <= 100) {
                                const discountedAmount = (discountPercent / 100) * orderTotal;
                                orderTotal -= discountedAmount;
                            }
                            // Display the updated order total
                            document.querySelector('.promo-container p').textContent = `$${orderTotal.toFixed(2)}`;
                            // Set orderTotal as a cookie
document.cookie = "orderTotal=" + orderTotal.toFixed(2);

                        }
                    };
                    xhr.send('promoCode=' + promoCode);
                } else {
                    // Alert the user to enter a promo code
                    alert('Please enter a promo code.');
                }
               
            });
        
   


var selectedDate = sessionStorage.getItem('selectedDate');

// Function to format the date from "DD Month YYYY Day" to "YYYY-MM-DD" format
function formatDate(selectedDate) {
    // Split the date string into its components
    var parts = selectedDate.split(' ');
    var day = parts[0]; // Day of the month
    var monthName = parts[1]; // Month name
    var year = parts[2]; // Year

    // Convert month name to month number
    var monthNumber = {
        "January": "01", "February": "02", "March": "03", "April": "04", "May": "05", "June": "06",
        "July": "07", "August": "08", "September": "09", "October": "10", "November": "11", "December": "12"
    }[monthName];

    // Format day and month to have leading zeros if necessary
    

    // Return the formatted date in "YYYY-MM-DD" format
    return year + '-' + monthNumber + '-' + day;
}

// Format the selected date
var formattedDate = formatDate(selectedDate);

// Create a hidden input field in your form and set its value to the formatted date
document.getElementById("selectedDate").value = formattedDate;

var selectedTime = sessionStorage.getItem('selectedTime');
document.getElementById("selectedTime").value = selectedTime;
console.log("Selected date:", selectedTime);

const selectedSeatValues = JSON.parse(sessionStorage.getItem('selectedSeatValues'));
document.getElementById('selectedSeatValues').value = JSON.stringify(selectedSeatValues);

console.log("Selected date:", selectedSeatValues);
var selectedShowroom = sessionStorage.getItem('selectedShowroom');
var numTicketsChild = sessionStorage.getItem('numTicketsChild');
document.getElementById("numTicketsChild").value = numTicketsChild;
var numTicketsAdult = sessionStorage.getItem('numTicketsAdult');
document.getElementById("numTicketsAdult").value = numTicketsAdult;
var numTicketsSenior = sessionStorage.getItem('numTicketsSenior');
document.getElementById("numTicketsSenior").value = numTicketsSenior;
});
</script>

</body>
</html>
