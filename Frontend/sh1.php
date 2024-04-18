<?php
session_start();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the selected movie ID and title from the $_POST array
    $selected_movie_id = $_POST['selected_movie_id'];
    $selected_movie_title = $_POST['selected_movie_title'];
// Store the values in session variables
$_SESSION['selected_movie_id'] = $selected_movie_id;
$_SESSION['selected_movie_title'] = $selected_movie_title;
    // Use the retrieved values as needed
    // For example, you can display the selected movie details
    echo "You selected Movie ID: " . $selected_movie_id . ", Title: " . $selected_movie_title;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Showtime Selection</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.min.css">
    <link rel="stylesheet" href="./stylesh.css">
    <style>
        .selected {
            /* Example styles for selected button */
            background-color: #007bff; /* Change color as needed */
            color: white;
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

            </div>
           
        </div>
    </div>
    <div class="screens">
        <h2>Select your show time!!!</h2>
    </div>
    <div class="screens">
        Showroom B
    </div>

    <div class="button-wrapper">
        <!-- Added data attributes to buttons for date values -->

       
        <button class="date-button" data-date="27 April 2024 Saturday">27 Saturday</button>
        <button class="date-button" data-date="28 April 2024 Sunday">28 Sunday</button>
    </div>

    <div class="time-btn">
        <!-- Updated onclick attribute to point to the correct function -->
        <button class="screen-time" data-time="11:00" data-showroom="Showroom B">11:00</button>
        <button class="screen-time" data-time="19:00" data-showroom="Showroom B">19:00</button>
    </div>

    <button class="new-button" onclick="saveSelection()">Next</button>

    <script>
        // Variable to hold the default month
        let defaultMonth = 'April';
        
        // Variables to hold selected date and time
        let selectedDate = null;
        let selectedTime = null;
        let selectedShowroom = null;
        // Select all date buttons and add click event listeners
        document.querySelectorAll('.date-button').forEach(button => {
            button.addEventListener('click', function() {
                // Remove 'selected' class from all date buttons
                document.querySelectorAll('.date-button').forEach(btn => btn.classList.remove('selected'));
                // Add 'selected' class to the clicked button
                this.classList.add('selected');
                // Set the selected date with the default month prefixed
                selectedDate = this.getAttribute('data-date');
            });
        });
    
        // Select all time buttons and add click event listeners
        document.querySelectorAll('.screen-time').forEach(button => {
                button.addEventListener('click', function() {
                // Remove 'selected' class from all time buttons
                document.querySelectorAll('.screen-time').forEach(btn => btn.classList.remove('selected'));
                // Add 'selected' class to the clicked button
                this.classList.add('selected');
                // Set the selected time
                selectedTime = this.getAttribute('data-time');
                selectedShowroom = this.getAttribute('data-showroom');
            });
        });
    
        // Function to save the selection to localStorage and show alert
        function saveSelection() {
            if (selectedDate && selectedTime) {
                // Store the selected date and time in session storage
                sessionStorage.setItem('selectedDate', selectedDate);
                sessionStorage.setItem('selectedTime', selectedTime);
                sessionStorage.setItem('selectedShowroom', selectedShowroom);
                // Redirect to the next page
                window.location.href = 'seat_sel.php';
            } else {
                alert('Please select a date and a time before pressing Next.');
            }
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.pkgd.min.js"></script>
</body>
</html>
