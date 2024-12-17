// Toggle menu untuk mobile
const menuButton = document.getElementById('menu-button');
const mobileMenu = document.getElementById('mobile-menu');

menuButton.addEventListener('click', () => {
  if (mobileMenu.classList.contains('hidden')) {
    mobileMenu.classList.remove('hidden');
    mobileMenu.classList.add('animate-popUpIn');
  } else {
    mobileMenu.classList.add('hidden');
    mobileMenu.classList.remove('animate-popUpIn');
  }
});

// Scroll Animation
document.addEventListener('DOMContentLoaded', () => {
  const scrollElements = document.querySelectorAll('.scroll-animate');

  const elementInView = (el, dividend = 1) => {
    const elementTop = el.getBoundingClientRect().top;
    return (
      elementTop <=
      (window.innerHeight || document.documentElement.clientHeight) / dividend
    );
  };

  const displayScrollElement = (element) => {
    element.classList.add('opacity-100', 'translate-y-0', 'animate-fadeIn');
    element.classList.remove('opacity-0', 'translate-y-4');
  };

  const hideScrollElement = (element) => {
    element.classList.remove('opacity-100', 'translate-y-0', 'animate-fadeIn');
    element.classList.add('opacity-0', 'translate-y-4');
  };

  const handleScrollAnimation = () => {
    scrollElements.forEach((el) => {
      if (elementInView(el, 1.25)) {
        displayScrollElement(el);
      } else {
        hideScrollElement(el);
      }
    });
  };

  window.addEventListener('scroll', handleScrollAnimation);
});
