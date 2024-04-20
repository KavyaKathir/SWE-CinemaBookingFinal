const movies = [
    { title: 'Anyone But You: The Valentine Encore ', showtime: '4:00 PM, 7:00 PM', director: 'Will Gluck', imageUrl: '/Frontend/img/new1.jpg', category: 'Comedy, Romance' },
    { title: 'Madame Web', showtime: '4:00 PM, 7:00 PM', director: 'S.J. Clarkson', imageUrl: '/Frontend/img/new2.jpg', category: 'Action, Sci-Fi' },
    { title: 'Lisa Frankenstein', showtime: '4:00 PM, 7:00 PM', director: 'Zelda Williams', imageUrl: '/Frontend/img/3.jpg', category: 'Comedy, Horror' },
    { title: 'Kingdom of the Planet of the Apes', showtime: '4:00 PM, 7:00 PM', director: 'Wes Ball', imageUrl: '/Frontend/img/new11.jpg', category: 'Action, Sci-Fi' },
    { title: 'A Quiet Place: Day One', showtime: '4:00 PM, 7:00 PM', director: 'Zelda Williams', imageUrl: '/Frontend/img/new10.jpg', category: 'Horror, Sci-Fi' }
];

document.addEventListener('DOMContentLoaded', function () {  
    const searchResultsContainer = document.getElementById('searchResults');
    const calendarContainer = document.getElementById('calendarContainer');
    let selectedDate = null;

    // Display all movies by default
    displayMovies(movies, searchResultsContainer);
    generateCalendarIcons();

    const searchForm = document.getElementById('searchForm');
    searchForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent form submission

        // Get search input values
        const query = document.getElementById('searchInput').value.trim().toLowerCase();
        const category = document.getElementById('categorySelect').value;

        // Filter movies based on search criteria
        const filteredMovies = movies.filter(movie => {
            const titleMatch = movie.title.toLowerCase().includes(query);
            const categoryMatch = category === '' || movie.category.includes(category);
            return titleMatch && categoryMatch;
        });

        // Display filtered movies or show "Not found..." message
        if (filteredMovies.length > 0) {
            displayMovies(filteredMovies, searchResultsContainer);
        } else {
            displayNotFoundMessage(searchResultsContainer);
        } // if
    });

    searchResultsContainer.addEventListener('click', function(event) {
        const target = event.target;
        if (target.classList.contains('see-details')) {
            const movieTitle = target.dataset.title;
            redirectToDetails(movieTitle);
        }
    });

    function displayMovies(movies, searchResultsContainer) {
        searchResultsContainer.innerHTML = ''; // Clear previous results

        movies.forEach(movie => {
            const movieElement = createMovieElement(movie);
            searchResultsContainer.appendChild(movieElement);
        });
    } // displayMovies

    function displayNotFoundMessage(searchResultsContainer) {
        searchResultsContainer.innerHTML = ''; // Clear previous results
        const messageElement = document.createElement('div');
        messageElement.textContent = 'Not found...';
        searchResultsContainer.appendChild(messageElement);
    } // displayNotFoundMessage

    function redirectToDetails(title) {
        // Redirect to movie details page with the selected movie title
        window.location.href = `selectmovie.html?title=${title}`;
    } // redirectToDetails

    function generateCalendarIcons() {
        const today = new Date(); // Get today's date
        const daysOfWeek = ['SUN', 'MON', 'TUE', 'WED', 'THUR', 'FRI', 'SAT'];
        const months = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUNE', 'JULY', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
        
        for (let i = 0; i < 7; i++) {
            const date = new Date(Date.UTC(today.getFullYear(), today.getMonth(), today.getDate() + i)); // Calculate UTC date for each day
            const monthName = months[date.getUTCMonth()];
            const dayOfMonth = date.getUTCDate();
            const dayOfWeek = daysOfWeek[date.getUTCDay()];
           
            const calendarIcon = document.createElement('div');
            calendarIcon.classList.add('calendar-icon');
            calendarIcon.innerHTML = `
                <div class="top">${dayOfWeek}</div>
                <div class="bottom">${monthName} ${dayOfMonth}</div>
            `;
            calendarIcon.addEventListener('click', function() {
                handleCalendarIconClick(date, calendarIcon);
            });
            calendarContainer.appendChild(calendarIcon);
        } // for
    } // generateCalendarIcons

    function handleCalendarIconClick(date, calendarIcon) {
        if (selectedDate === date) {
            // Deselect the selected date
            selectedDate = null;
            calendarIcon.classList.remove('selected');
            // Redirect to the default search page
            window.location.href = 'search.html';
        } else {
            selectedDate = date;
            const allCalendarIcons = document.querySelectorAll('.calendar-icon');
            allCalendarIcons.forEach(icon => icon.classList.remove('selected'));
            calendarIcon.classList.add('selected');
            
            // Update the hidden input field with the selected show date
            const selectedShowDateField = document.getElementById('selectedShowDate');
            
            // Get YYYY-MM-DD format
            selectedShowDateField.value = date.toISOString().split('T')[0];            

            showMoviesForSelectedDate(date);
        } // if
    } // handleCalendarIconClick

    function showMoviesForSelectedDate(date) {
        const searchResultsContainer = document.getElementById('searchResults');
        searchResultsContainer.innerHTML = ''; // Clear previous results
        const differenceInDays = Math.floor((date.getTime() - Date.now()) / (1000 * 60 * 60 * 24));

        if (differenceInDays < 4) {
            // Show the first three movies for the first 5 days
            movies.slice(0, 3).forEach(movie => {
                const movieElement = createMovieElement(movie);
                searchResultsContainer.appendChild(movieElement);
            });
        } else {
            // Show the last two movies for the remaining 2 days
            movies.slice(3).forEach(movie => {
                const movieElement = createMovieElement(movie);
                searchResultsContainer.appendChild(movieElement);
            });
        } // if

        // Show show time options for the selected date
        showTimeOptions();

        // Show show time under movie title for selected date
        const showTimeElements = document.querySelectorAll('.show-time');
        showTimeElements.forEach(element => element.style.display = 'block');
    } // showMoviesForSelectedDate
    
    function showTimeOptions() {
        const showTimeOptions = document.querySelectorAll('.show-time-options');
        showTimeOptions.forEach(option => option.style.display = 'block');
    } // showTimeOptions

    function createMovieElement(movie) {
        const movieElement = document.createElement('div');
        movieElement.classList.add('movie');
        movieElement.innerHTML = `
            <div class="movie-details">
                <img src="${movie.imageUrl}" alt="${movie.title}">
                <p><strong></strong> ${movie.title}</p>
                <p class="show-time" style="display: none;"><strong></strong> ${movie.showtime}</p>
            </div>
            <div class="button-container">
                <button class="end-btn see-details" data-title="${movie.title}">See Details</button>
            </div>
        `;
        return movieElement;
    } // createMovieElement
});
