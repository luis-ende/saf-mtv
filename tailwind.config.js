const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                'mtv-gold': '#bc955c',
                'mtv-primary': '#9f2241',
                'mtv-secondary': '#235b4e',
                'mtv-gray': '#6F7271',
                'mtv-text-gray': '#6F7271',
            },
            fontFamily: {
                sans: ['Source Sans Pro', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
