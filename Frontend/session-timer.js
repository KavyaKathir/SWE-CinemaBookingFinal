// session-timer.js

// Function to start or resume the countdown timer
function startOrResumeCountdown() {
    // Check if there is remaining time stored in session storage
    var remainingTime = sessionStorage.getItem('remainingTime');

    // If there is remaining time, resume the countdown
    if (remainingTime) {
        remainingTime = parseInt(remainingTime);
        startCountdown(remainingTime);
    } else {
        // Otherwise, start a new countdown with the initial time
        var initialTime = 10 * 60; // 15 minutes in seconds
        startCountdown(initialTime);
    }
}

// Function to start the countdown timer
function startCountdown(totalSeconds) {
    // Get the countdown element
    var countdownElement = document.getElementById('countdown');

    // Update the countdown display every second
    var countdown = setInterval(function() {
        // Calculate minutes and seconds
        var minutes = Math.floor(totalSeconds / 60);
        var seconds = totalSeconds % 60;

        // Add leading zeros if necessary
        minutes = String(minutes).padStart(2, '0');
        seconds = String(seconds).padStart(2, '0');

        // Display the time
        countdownElement.textContent = minutes + ':' + seconds;

        // Stop the countdown when timer reaches 0
        if (totalSeconds <= 0) {
            clearInterval(countdown);
            // Set the body content to display the expiration message
            document.body.innerHTML = '<h1>Your session has expired.</h1>';
            // Add additional actions here when the session expires
           // Redirect to a new page
                 } else {
            // Decrement totalSeconds
            totalSeconds--;

            // Store the remaining time in session storage
            sessionStorage.setItem('remainingTime', totalSeconds);
        }
    }, 1000); // Update every 1 second
}

// Call the startOrResumeCountdown function to begin or resume the timer
startOrResumeCountdown();
