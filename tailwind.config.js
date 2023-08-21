/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        visionRed: "#ED1C24",
        visionGray: "#F9F9F9",
        visionBlue: "#005faf"
      },
    },
  },
  plugins: [],
}

