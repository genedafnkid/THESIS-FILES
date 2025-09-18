const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter', 'ui-sans-serif', 'system-ui'],
      },
      colors: {
        brand: {
          50: '#f8f7ff',
          100: '#efeafe',
          200: '#ddd0fd',
          300: '#c1a6fb',
          400: '#a178f6',
          500: '#854df0',
          600: '#6f35d9',
          700: '#5b29b4',
          800: '#4b2392',
          900: '#3e1d79',
        },
      },
      boxShadow: {
        glow: '0 10px 30px rgba(133, 77, 240, 0.35)',
      },
      backgroundImage: {
        grid: "radial-gradient(circle at 1px 1px, rgb(255 255 255 / 0.35) 1px, transparent 0)",
      }
    }
  },
  
    plugins: [require('@tailwindcss/forms')],
};


