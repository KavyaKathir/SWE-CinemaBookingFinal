document.addEventListener('DOMContentLoaded', function () {
    const movieDetailsContainer = document.getElementById('movieDetails');
    const params = new URLSearchParams(window.location.search);
    const movieTitle = params.get('title');
    const movieTitleInput = document.getElementById('movieTitleInput');

    if (movieTitle) {
        // Display movie details based on the title parameter
        displayMovieDetails(movieTitle, movieDetailsContainer);
        // Set the movie title in the hidden input field
        movieTitleInput.value = movieTitle;
    } else {
        movieDetailsContainer.textContent = 'Movie not found.';
    }

    // Event delegation for "See Details" button click
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
    });
});

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
            duration: '2 hours 25 minutes',
            imageUrl: './img/new1.jpg',
            trailer: 'https://www.youtube.com/embed/UtjH6Sk7Gxs',
            reviews: [
                { title: 'Fantastic Movie!', author: 'Nathan Lagel', rating: '5/5', content: 'This movie was absolutely amazing. Excellent direction! I highly recommend it to anyone looking for a great film!' },
                { title: 'Good, ok', author: 'Wane Smith', rating: '3/5', content: 'I was really looking forward to this movie, but unfortunately, it didn\'t live up to most of the expectations.' }
            ]
        },
        'Madame Web': {
            category: 'Action, Sci-Fi',
            cast: 'Dakota Johnson, Sydney Sweeney, Isabela Merced',
            director: 'S.J. Clarkson',
            producer: 'Lorenzo di Bonaventura',
            synopsis: 'Cassandra Webb is a New York City paramedic who starts to show signs of clairvoyance. Forced to confront revelations about her past, she must protect three young women from a mysterious adversary who wants them dead.',
            ratingCode: 'PG-13',
            duration: '1 hour 54 minutes',
            imageUrl: './img/new2.jpg',
            trailer: 'https://www.youtube.com/embed/s_76M4c4LTo',
            reviews: [
                { title: 'Mind-blowing!', author: 'Sarah Johnson', rating: '4.5/5', content: 'This movie exceeded all my expectations. A must-watch for sci-fi fans!' },
                { title: 'Could have been better', author: 'David Smith', rating: '3/5', content: 'While the concept was intriguing, the execution fell short in some areas.' }
            ]
        },
        'Lisa Frankenstein': {
            category: 'Comedy, Horror',
            cast: 'Kathryn Newton, Cole Sprouse, Liza Soberano',
            director: 'Zelda Williams',
            producer: 'Mason Novick, Diablo Cody',
            synopsis: 'A misunderstood teenager and a reanimated Victorian corpse embark on a murderous journey together to find love, happiness, and a few missing body parts.',
            ratingCode: 'PG-13',
            duration: '1 hour 41 minutes',
            imageUrl: './img/3.jpg',
            trailer: 'https://www.youtube.com/embed/POOeA3zCuUY',
            reviews: [
                { title: 'A Quirky Gem!', author: 'HorrorFanatic42', rating: '4/5', content: 'A delightful mix of horror and comedy. The performances are fantastic, and the storyline keeps you engaged throughout.' },
                { title: 'Unique and Entertaining', author: 'FilmBuff2023', rating: '3.5/5', content: 'ffers a fresh take on the horror genre with comedic elements. Fans of offbeat horror will appreciate its charm.' }
            ]
        },
        'Kingdom of the Planet of the Apes': {
            category: 'Action, Sci-Fi',
            cast: 'Owen Teague, Freya Allan, Kevin Durand',
            director: 'Wes Ball',
            producer: 'Wes Ball, Joe Hartwick Jr.,Rick Jaffa, Amanda Silver, Jason Reed',
            synopsis: 'Many years after the reign of Caesar, a young ape goes on a journey that will lead him to question everything he has been taught about the past and make choices that will define a future for apes and humans alike.',
            ratingCode: 'PG-13',
            duration: '2 hours',
            imageUrl: './img/new11.jpg',
            trailer: 'https://www.youtube.com/embed/XtFI7SNtVpY',
            reviews: [
                { title: 'Epic Sci-Fi Adventure!', author: 'SciFiGeek88', rating: '4.5/5', content: 'A thrilling continuation of the beloved franchise. Stunning visual effects and an engaging story.' },
                { title: 'Captivating Storyline', author: 'MovieEnthusiast2024', rating: '4/5', content: 'Delivers an engaging narrative with commendable performances and exhilarating action sequences.' }
            ]
        },
        'A Quiet Place: Day One': {
            category: 'Horror, Sci-Fi',
            cast: 'Lupita Nyongo, Joseph Quinn, Alex Wolff',
            director: 'Michael Sarnoski',
            producer: 'Michael Bay\r\nAndrew Form, Brad Fuller, John Krasinski',
            synopsis: 'Experience the day the world went quiet.',
            ratingCode: 'PG-13',
            duration: '2 hours 40 minutes',
            imageUrl: './img/new10.jpg',
            trailer: 'https://www.youtube.com/embed/YPY7J-flzE8',
            reviews: [
                { title: 'Intense and Gripping!', author: 'ThrillerFanatic', rating: '4.5/5', content: 'A masterclass in suspense and tension. Superb direction and top-notch performances.' },
                { title: 'Nail-Biting Experience', author: 'CinemaJunkie', rating: '4/5', content: 'Keeps you at the edge of your seat with intense atmosphere and well-crafted suspense.' }
            ]
        }
    };
    if (movieDetails.hasOwnProperty(title)) {
        const movie = movieDetails[title];
        const movieElement = document.createElement('div');
        movieElement.classList.add('movie-details');
        movieElement.innerHTML = `
            <img src="${movie.imageUrl}" alt="${title}">
            <div class="details">
                <h2>${title}</h2>
                <p><strong>Category:</strong> ${movie.category}</p>
                <p><strong>Cast:</strong> ${movie.cast}</p>
                <p><strong>Director:</strong> ${movie.director}</p>
                <p><strong>Producer:</strong> ${movie.producer}</p>
                <p><strong>Synopsis:</strong> ${movie.synopsis}</p>
                <p><strong>MPAA-US Rating Code:</strong> ${movie.ratingCode}</p>
                <p><strong>Duration:</strong> ${movie.duration}</p>
                <iframe width="560" height="315" src="${movie.trailer}" frameborder="0" allowfullscreen></iframe>
            </div>
        `;
        const reviewsElement = document.createElement('div');
        reviewsElement.classList.add('review-box');
        movie.reviews.forEach(review => {
            reviewsElement.innerHTML += `
                <div class="review-title">${review.title}</div>
                <div class="review-author">- ${review.author}</div>
                <div class="review-rating">
                    Rating: <span>${review.rating}</span>
                </div>
                <div class="review-content">${review.content}</div>
            `;
        });
        movieElement.appendChild(reviewsElement);
        container.appendChild(movieElement);
    } else {
        container.textContent = 'Movie details not available.';
    }
} // displayMovieDetails
