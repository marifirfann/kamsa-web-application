/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js}"],
  theme: {
    extend: {
      fontFamily: {
        'Montserrat': ['"Montserrat"', 'sans-serif'],
      },
      colors: {
        'blue1': '#2C99FF',
        'blue-text': '#005BB0',
        'blue-black': '#002A51',
        'silver-custom1': '#222222',
        'silver-custom2': '#2B2B2B',
        'silver-text-custom': '#1F1F1F',
        'footer-baground': '#E1E1E1',
      },
      screens: {
        'miniphone': { 'min': '1px', 'max': '399px' },
        'phone': { 'min': '0px', 'max': '639px' },
        'tablet': { 'min': '640px', 'max': '1023px' },
        'laptop': { 'min': '1024px', 'max': '1279px' },
        'desktop': { 'min': '1280px' },
      },
      backgroundImage: {
        'landing-page2': "url('/img/kamsa/backgrond222.png')",
      },
      animation: {
        fadeIn: 'fadeIn 1s ease-in-out',
        popUpIn: 'popUpIn 0.5s ease-in',
        popUpOut: 'popUpOut 0.5s ease-out',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0', transform: 'translateY(20px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
        popUpIn: {
          '0%': {
            opacity: '0',
            transform: 'scale(0.8)', // Mulai kecil
          },
          '100%': {
            opacity: '1',
            transform: 'scale(1)', // Normal
          },
        },
        popUpOut: {
          '0%': {
            opacity: '0',
            transform: 'scale(1.2)', // Mulai besar
          },
          '100%': {
            opacity: '1',
            transform: 'scale(1)', // Normal
          },
        },
      },
    },
  },
  plugins: [],
};
