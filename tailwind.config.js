/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/views/welcome.blade.php",
    "./resources/views/index.blade.php",
    "./resources/views/show.blade.php",
    "./resources/views/layouts/main.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      width: {
        '96' : '24rem',
      }
    },
  },
  plugins: [],
}
