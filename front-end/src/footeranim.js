const carouselItems = document.querySelectorAll('.carousel-item');
const dots = document.querySelectorAll('.dot');
let currentIndex = 0;

// Update the carousel to show the correct item
function updateCarousel(newIndex) {
    // Remove active class and set the correct transition for next/prev items
    carouselItems[currentIndex].classList.remove('active');
    carouselItems[currentIndex].classList.add(newIndex > currentIndex ? 'next' : 'prev');

    // Set the new item as active
    carouselItems[newIndex].classList.remove('next', 'prev');
    carouselItems[newIndex].classList.add('active');

    // Update the dot status
    dots.forEach((dot, i) => {
        dot.classList.toggle('dot-active', i === newIndex);
    });

    currentIndex = newIndex;
}

// Auto slide every 5 seconds
function autoSlide() {
    let nextIndex = (currentIndex + 1) % carouselItems.length;
    updateCarousel(nextIndex);
}

let slideInterval = setInterval(autoSlide, 5000);

// Control the carousel with dots
dots.forEach(dot => {
    dot.addEventListener('click', (e) => {
        const index = parseInt(e.target.getAttribute('data-index'));
        updateCarousel(index);
        clearInterval(slideInterval);
        slideInterval = setInterval(autoSlide, 5000);
    });
});

// Initialize the carousel
updateCarousel(currentIndex);