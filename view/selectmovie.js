document.addEventListener('DOMContentLoaded', function () {
    const moviePosterContainer = document.getElementById('moviePoster');
    const movieDetailsContainer = document.getElementById('movieDetails');
    const trailerContainer = document.getElementById('movieTrailer');
    const reviewContainer = document.getElementById('movieReview');

    const params = new URLSearchParams(window.location.search);
    const movieTitle = params.get('title');
    const movieTitleInput = document.getElementById('movieTitleInput');

    if (movieTitle) {
        // Display movie poster based on the title parameter
        displayMoviePoster(movieTitle, moviePosterContainer);

        // Display movie details based on the title parameter
        displayMovieDetails(movieTitle, movieDetailsContainer);

        // Display movie trailer based on the title parameter
        displayMovieTrailer(movieTitle, trailerContainer);

        // Display movie reviews based on the title parameter
        displayMovieReview(movieTitle, reviewContainer);

        // Set the movie title in the hidden input field
        movieTitleInput.value = movieTitle;
    } else {
        moviePosterContainer.textContent = 'Movie not found.';
        movieDetailsContainer.textContent = 'Movie not found.';
        trailerContainer.textContent = 'Movie not found.';
        reviewContainer.textContent = 'Movie not found.';
    } // if

    // Event delegation for "See Details" button click
    moviePosterContainer.addEventListener('click', function (event) {
        if (event.target.classList.contains('see-details-btn')) {
            const selectedMovieTitle = event.target.dataset.title;
            if (selectedMovieTitle) {
                // Set the movie title in the hidden input field
                movieTitleInput.value = selectedMovieTitle;
                // Submit the form to showtime.html
                document.getElementById('bookTicketsForm').submit();
            }
        }
    }); // moviePosterContainer

    movieDetailsContainer.addEventListener('click', function (event) {
        if (event.target.classList.contains('see-details-btn')) {
            const selectedMovieTitle = event.target.dataset.title;
            if (selectedMovieTitle) {
                // Set the movie title in the hidden input field
                movieTitleInput.value = selectedMovieTitle;
                // Submit the form to showtime.html
                document.getElementById('bookTicketsForm').submit();
            }
        }
    }); // movieDetailsContainer

    trailerContainer.addEventListener('click', function (event) {
        if (event.target.classList.contains('see-details-btn')) {
            const selectedMovieTitle = event.target.dataset.title;
            if (selectedMovieTitle) {
                // Set the movie title in the hidden input field
                movieTitleInput.value = selectedMovieTitle;
                // Submit the form to showtime.html
                document.getElementById('bookTicketsForm').submit();
            }
        }
    }); // trailerContainer

    reviewContainer.addEventListener('click', function (event) {
        if (event.target.classList.contains('see-details-btn')) {
            const selectedMovieTitle = event.target.dataset.title;
            if (selectedMovieTitle) {
                // Set the movie title in the hidden input field
                movieTitleInput.value = selectedMovieTitle;
                // Submit the form to showtime.html
                document.getElementById('bookTicketsForm').submit();
            }
        }
    }); // reviewContainer
});

function displayMoviePoster(title, container) {
    const moviePoster = {
        'Anyone But You: The Valentine Encore': {
            imageUrl: '/Frontend/img/new1.jpg'
        },
        'Madame Web': {
            imageUrl: '/Frontend/img/new2.jpg'
        },
        'Lisa Frankenstein': {
            imageUrl: '/Frontend/img/3.jpg'
        },
        'Kingdom of the Planet of the Apes': {
            imageUrl: '/Frontend/img/new11.jpg'
        },
        'A Quiet Place: Day One': {
            imageUrl: '/Frontend/img/new10.jpg'
        }
    };
    if (moviePoster.hasOwnProperty(title)) {
        const movie = moviePoster[title];
        const posterElement = document.createElement('div');
        posterElement.classList.add('movie-poster');
        posterElement.innerHTML = `
            <img src="${movie.imageUrl}" alt="${title}">
        `;
        container.appendChild(posterElement);
    } else {
        container.textContent = 'Movie poster is not available.';
    }
} // displayMoviePoster

function displayMovieDetails(title, container) {
    // You can fetch movie details from your data or API here
    // For demonstration, we'll manually create movie details
    const movieDetails = {
        'Anyone But You: The Valentine Encore': {
            category: 'Comedy, Romance',
            cast: 'Sydney Sweeney, Glen Powell',
            director: 'Will Gluck',
            producer: 'Will Gluck, Joe Roth, Jeff Kirschenbaum',
            synopsis: 'After an amazing first date, Bea and Ben fiery attraction turns ice-cold--until they find themselves unexpectedly reunited at a destination wedding in Australia. So they do what any two mature adults would do: pretend to be a couple.',
            ratingCode: 'R',
            duration: '2 hours 25 minutes'
        },
        'Madame Web': {
            category: 'Action, Sci-Fi',
            cast: 'Dakota Johnson, Sydney Sweeney, Isabela Merced',
            director: 'S.J. Clarkson',
            producer: 'Lorenzo di Bonaventura',
            synopsis: 'Cassandra Webb is a New York City paramedic who starts to show signs of clairvoyance. Forced to confront revelations about her past, she must protect three young women from a mysterious adversary who wants them dead.',
            ratingCode: 'PG-13',
            duration: '1 hour 54 minutes'
        },
        'Lisa Frankenstein': {
            category: 'Comedy, Horror',
            cast: 'Kathryn Newton, Cole Sprouse, Liza Soberano',
            director: 'Zelda Williams',
            producer: 'Mason Novick, Diablo Cody',
            synopsis: 'A misunderstood teenager and a reanimated Victorian corpse embark on a murderous journey together to find love, happiness, and a few missing body parts.',
            ratingCode: 'PG-13',
            duration: '1 hour 41 minutes'
        },
        'Kingdom of the Planet of the Apes': {
            category: 'Action, Sci-Fi',
            cast: 'Owen Teague, Freya Allan, Kevin Durand',
            director: 'Wes Ball',
            producer: 'Wes Ball, Joe Hartwick Jr.,Rick Jaffa, Amanda Silver, Jason Reed',
            synopsis: 'Many years after the reign of Caesar, a young ape goes on a journey that will lead him to question everything he has been taught about the past and make choices that will define a future for apes and humans alike.',
            ratingCode: 'PG-13',
            duration: '2 hours'
        },
        'A Quiet Place: Day One': {
            category: 'Horror, Sci-Fi',
            cast: 'Lupita Nyongo, Joseph Quinn, Alex Wolff',
            director: 'Michael Sarnoski',
            producer: 'Michael Bay\r\nAndrew Form, Brad Fuller, John Krasinski',
            synopsis: 'Experience the day the world went quiet.',
            ratingCode: 'PG-13',
            duration: '2 hours 40 minutes'
        }
    };
    if (movieDetails.hasOwnProperty(title)) {
        const movie = movieDetails[title];
        const movieElement = document.createElement('div');
        movieElement.classList.add('movie-details');
        movieElement.innerHTML = `
            <div class="details">
                <h1>${title}</h1>
                <p><strong>Category:</strong> ${movie.category}</p>
                <p><strong>Cast:</strong> ${movie.cast}</p>
                <p><strong>Director:</strong> ${movie.director}</p>
                <p><strong>Producer:</strong> ${movie.producer}</p>
                <p><strong>Synopsis:</strong> ${movie.synopsis}</p>
                <p><strong>MPAA-US Rating Code:</strong> ${movie.ratingCode}</p>
                <p><strong>Duration:</strong> ${movie.duration}</p>
            </div>
        `;
        container.appendChild(movieElement);
    } else {
        container.textContent = 'Movie details are not available.';
    }
} // displayMovieDetails

function displayMovieTrailer(title, container) {
    const movieTrailer = {
        'Anyone But You: The Valentine Encore': {
            trailer: 'https://www.youtube.com/embed/UtjH6Sk7Gxs'
        },
        'Madame Web': {
            trailer: 'https://www.youtube.com/embed/s_76M4c4LTo'
        },
        'Lisa Frankenstein': {
            trailer: 'https://www.youtube.com/embed/POOeA3zCuUY'
        },
        'Kingdom of the Planet of the Apes': {
            trailer: 'https://www.youtube.com/embed/XtFI7SNtVpY'
        },
        'A Quiet Place: Day One': {
            trailer: 'https://www.youtube.com/embed/YPY7J-flzE8'
        }
    };
    if (movieTrailer.hasOwnProperty(title)) {
        const movie = movieTrailer[title];
        const trailerElement = document.createElement('div');
        trailerElement.classList.add('movie-trailer');
        trailerElement.innerHTML = `
            <iframe width="560" height="315" src="${movie.trailer}" frameborder="0" allowfullscreen></iframe>
        `;
        container.appendChild(trailerElement);
    } else {
        container.textContent = 'Movie trailer is not available.';
    }
} // displayMovieTrailer

function displayMovieReview(title, container) {
    const movieReview = {
        'Anyone But You: The Valentine Encore': {
            reviews: [
                { title: '"Amazing!!!" - Peter Parker', rating: '4/5' },
                { title: '"Great direction" - Tony Stark', rating: '4/5' }
            ],
            status: 'now-playing'
        },
        'Madame Web': {
            reviews: [
                { title: '"Love it" - Christian Grey', rating: '4.5/5' },
                { title: '"Mind blowing!" - Anastasia Steele', rating: '4.5/5' }
            ],
            status: 'now-playing'
        },
        'Lisa Frankenstein': {
            reviews: [
                { title: '"Hmmm.." - Willy Wonka', rating: '3/5' },
                { title: '"Unique" - Cruella de Vil', rating: '3/5' }
            ],
            status: 'now-playing'
        },
        'Kingdom of the Planet of the Apes': {
            reviews: [
                { title: '"Interested" - Pepper Potts', rating: '-/5' },
                { title: '"Interested" - Happy Hogan', rating: '-/5' }
            ],
            status: 'coming-soon'
        },
        'A Quiet Place: Day One': {
            reviews: [
                { title: '"Interested" - Mary Jane', rating: '-/5' },
                { title: '"Interested" - Ned Leeds', rating: '-/5' }
            ],
            status: 'coming-soon'
        }
    };
    if (movieReview.hasOwnProperty(title)) {
        const movie = movieReview[title];
        const reviewsElement = document.createElement('div');
        reviewsElement.classList.add('movie-review');
        movie.reviews.forEach((review, index) => {
            reviewsElement.innerHTML += `
                <div class="review-rating">${review.rating}</div>
                <div class="review-title">${review.title}</div>
                <br>
            `;
        });
        // Add "Book Tickets" button with different behavior based on movie status
        if (movie.status === 'now-playing') {
            reviewsElement.innerHTML += `
                <div class="book-button-container">
                    <a href="showtime.html">
                        <img src="/Frontend/img/booking4.png" alt="Booking Icon" class="booking-icon">
                    </a>
                </div>
            `;
        } else if (movie.status === 'coming-soon') {
            reviewsElement.innerHTML += `
                <div class="book-button-container">
                    <a href="showtimeComingSoon.html">
                        <img src="/Frontend/img/booking4.png" alt="Booking Icon" class="booking-icon">
                    </a>
                </div>
            `;
        } // if
        container.appendChild(reviewsElement);
    } else {
        container.textContent = 'Movie reviews are not available.';
    }
} // displayMovieReview
