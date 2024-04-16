<?php
session_start();
if (isset($_SESSION['selected_movie_id']) && isset($_SESSION['selected_movie_title'])) {
    $selected_movie_id = $_SESSION['selected_movie_id'];
    $selected_movie_title = $_SESSION['selected_movie_title'];
    echo "MOVIE:       " . $selected_movie_title;
} else {
    echo "Movie details not found.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="seat-style.css" />
    <title>Select seat</title>
    <style>
        body{color:white !important;
        margin: 0;
    padding: 0; }

.navbar {
    width: 100%;
    height: 50px;
    background-color: black;
    margin: 0;
    padding: 0;
    border-bottom: 10px solid white;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 999;
}

.navbar-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 50px;
    height: 100%;
    color: white;
    font-family: 'Sen', sans-serif;
}

.logo {
     font-style: 20px;
     color: #910142;
     cursor: default;
     transition: 1s ease;
      margin-right: 10px;
 }

 .logo:hover {
     color: #b70153;
 }

.logo-container {
    display: flex;
    align-items: center;
}
.big-button {
    font-size: 10px;
    padding: 10px 20px;
    margin-right:0px;
}
.nav-buttons {
            display: flex;
            justify-content: space-around;
            padding: 10px;
            border-radius: 5px;
        }

        .nav-buttons button {
            padding: 5px 10px;
            justify-content: space-between;
            border: none;
            background-color: red;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

.nav-buttons button:hover {
    color: yellow;
}
.nav-buttons button{
            margin-right: 20px;
        }
        .nav-buttons button:hover {
            background-color: purple;
        }

        .proceed-button {
           background-color: transparent;
           color: red;
           border: none;
           padding: 5px 10px;
           cursor: pointer;
           font-size: 25px;
       }
        .proceed-button:hover {
           background-color: white;
       }
       .session-expire {
          text-align: center;
          color: #fff;
          font-size: 14px;
          margin-top: 20px;
        }

        </style>
</head>
<body>
<div class="navbar">
    <div class="navbar-container">
        <div class="logo-container">
            <div>
                <h1 class="logo">MOVIELANE</h1>
            </div>
            <div>
                <button id="home" class="big-button">HOME</button>
            </div>
        </div>
       
    </div>
</div>

<h2>Your session will expire in <span id="countdown">15:00</span>. Please checkout within this time to reserve your seats!.</h2> 
<script src="session-timer.js"></script>
</div>
<ul class="showcase">
    <li>
        <div class="seat"></div>
        <small>Available</small>
    </li>
    <li>
        <div class="seat selected"></div>
        <small>Selected</small>
    </li>
    <li>
        <div class="seat sold"></div>
        <small>Sold</small>
    </li>
</ul>
<div class="container">
    <div class="screen"></div>

 
    <div class="row">
    <div class="column-name"></div> <!-- Empty div for spacing -->
    <div class="column-name"></div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;<div class="column-name">1</div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="column-name">2</div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="column-name">3</div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="column-name">4</div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="column-name">5</div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="column-name">6</div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="column-name">7</div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="column-name">8</div>
</div>

    <div class="row">
        A &nbsp; <div class="seat" data-value="A1"></div>
        <div class="seat" data-value="A2"></div>
        <div class="seat" data-value="A3"></div>
        <div class="seat" data-value="A4"></div>
        <div class="seat" data-value="A5"></div>
        <div class="seat" data-value="A6"></div>
        <div class="seat" data-value="A7"></div>
        <div class="seat" data-value="A8"></div>
    </div>

    <div class="row">
        B &nbsp; <div class="seat" data-value="B1"></div>
        <div class="seat" data-value="B2"></div>
        <div class="seat" data-value="B3"></div>
        <div class="seat sold" data-value="B4"></div>
        <div class="seat sold" data-value="B5"></div>
        <div class="seat" data-value="B6"></div>
        <div class="seat" data-value="B7"></div>
        <div class="seat" data-value="B8"></div>
    </div>
    <div class="row">
        C &nbsp; <div class="seat" data-value="C1"></div>
        <div class="seat" data-value="C2"></div>
        <div class="seat" data-value="C3"></div>
        <div class="seat sold" data-value="C4"></div>
        <div class="seat sold" data-value="C5"></div>
        <div class="seat" data-value="C6"></div>
        <div class="seat" data-value="C7"></div>
        <div class="seat" data-value="C8"></div>
    </div>
    <div class="row">
        D &nbsp; <div class="seat" data-value="D1"></div>
        <div class="seat sold" data-value="D2"></div>
        <div class="seat" data-value="D3"></div>
        <div class="seat" data-value="D4"></div>
        <div class="seat" data-value="D5"></div>
        <div class="seat" data-value="D6"></div>
        <div class="seat" data-value="D7"></div>
        <div class="seat sold" data-value="D8"></div>
    </div>
    <div class="row">
        E &nbsp;&nbsp; <div class="seat sold" data-value="E1"></div>
        <div class="seat" data-value="E2"></div>
        <div class="seat" data-value="E3"></div>
        <div class="seat" data-value="E4"></div>
        <div class="seat" data-value="E5"></div>
        <div class="seat" data-value="E6"></div>
        <div class="seat sold" data-value="E7"></div>
        <div class="seat" data-value="E8"></div>
    </div>

</div>

<p>
    You should select <span id="selected-seats-count"></span> seats. You have selected <span id="selected-count">0</span> seat(s). Selected seats are: <span id="selected-seats"></span>
</p>

<button class="proceed-button" id="proceedBtn">Proceed to Order</button>

  
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.querySelector('.container');
        const seats = document.querySelectorAll('.row .seat:not(.sold)');
        const selectedSeatsDisplay = document.getElementById('selected-seats');
        const selectedCountDisplay = document.getElementById('selected-count');
        const totalCountDisplay = document.getElementById('selected-seats-count');

        const selectedSeatsCount = sessionStorage.getItem('selectedSeats');
        document.getElementById('selected-seats-count').textContent = selectedSeatsCount;
        totalCountDisplay.textContent = selectedSeatsCount;


function updateSelectedCount() {
    const selectedSeats = document.querySelectorAll('.row .seat.selected');
    const maxSeatsCount = sessionStorage.getItem('selectedSeats');

    // Filter out selected seats exceeding the max count
    const validSelectedSeats = Array.from(selectedSeats).slice(0, maxSeatsCount);

    // Update the count and display the selected seats
    const count = validSelectedSeats.length;
    selectedCountDisplay.textContent = count;

    const selectedSeatValues = validSelectedSeats.map(seat => seat.dataset.value);
    selectedSeatsDisplay.textContent = selectedSeatValues.join(', ');
    sessionStorage.setItem('selectedSeatValues', JSON.stringify(selectedSeatValues));
}

container.addEventListener('click', e => {
    if (e.target.classList.contains('seat') && !e.target.classList.contains('sold')) {
        const selectedSeats = document.querySelectorAll('.row .seat.selected');
        const selectedSeatsCount = selectedSeats.length;
        const maxSeatsCount = sessionStorage.getItem('selectedSeats');

        // Check if the clicked seat is already selected
        const isAlreadySelected = e.target.classList.contains('selected');

        // Check if selecting the seat would not exceed the maximum count
        const isBelowMaxCount = selectedSeatsCount < maxSeatsCount;

        if (!isAlreadySelected && isBelowMaxCount) {
            // If the seat is not selected and selecting it would not exceed the max count, allow selection
            e.target.classList.add('selected');
            updateSelectedCount();
        } else if (isAlreadySelected) {
            // If the seat is already selected, allow deselection
            e.target.classList.remove('selected');
            updateSelectedCount();
        } else {
            // If selecting the seat would exceed the max count, show an alert
            alert(`You can only select ${maxSeatsCount} seats.`);
        }
    }
});

var proceedBtn = document.getElementById('proceedBtn');

// Add click event listener
proceedBtn.addEventListener('click', function() {
    // Get the total number of seats
    var totalSeats = document.querySelectorAll('.row .seat:not(.sold)').length;

    // Get the number of selected seats
    var selectedSeats = document.querySelectorAll('.row .seat.selected').length;

    // Get the maximum number of seats allowed
    var maxSeatsCount = sessionStorage.getItem('selectedSeats');

    // Check if all seats are selected
    if (selectedSeats < maxSeatsCount) {
        alert('Please select all seats before proceeding to order.');
    } else {
        window.location.href = 'order_summary.php';
    }
});
    });
</script>
</body>
</html>
