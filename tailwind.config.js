/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        './vendor/awcodes/overlook/resources/**/*.blade.php',
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
              sans: ['Inter'],
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}

