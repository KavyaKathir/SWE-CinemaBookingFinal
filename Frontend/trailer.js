    document.addEventListener('DOMContentLoaded', function() {
        const track = document.querySelector('.carousel-track');
        const items = document.querySelectorAll('.carousel-item');
        const prevButton = document.querySelector('.carousel-prev');
        const nextButton = document.querySelector('.carousel-next');
        let index = 0;
        const itemWidth = items[0].getBoundingClientRect().width;

        prevButton.addEventListener('click', () => {
            index = Math.max(index - 1, 0);
            updateCarousel();
        });

        nextButton.addEventListener('click', () => {
            index = Math.min(index + 1, items.length - 1);
            updateCarousel();
        });

        function updateCarousel() {
            const offset = -index * itemWidth;
            track.style.transform = `translateX(${offset}px)`;
        }
    });
