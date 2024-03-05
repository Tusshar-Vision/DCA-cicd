/** @type {import('tailwindcss').Config}
 *
 */


export default {
    darkMode: 'selector',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                visionRed: "#ED1C24",
                visionGray: "#F9F9F9",
                visionBlue: "#005faf",
                visionSelectedGray: "#EFEFEF",
                visionLineGray: "#8F93A3",
                visionToolTip: "#04040499"
            },
            fontFamily: {
              sans: ['Poppins', 'Arial'],
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}

