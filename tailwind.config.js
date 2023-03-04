const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],

    theme: {
        extend: {
            screens: {
                'xs': '320px',
            },
            colors: {
                'mtv-gold': '#bc955c',
                'mtv-gold-light': '#ddc9a3',
                'mtv-primary': '#9f2241',
                'mtv-secondary': '#235b4e',
                'mtv-secondary-dark': '#10312b',
                'mtv-gray': '#6f7271',
                'mtv-gray-light': '#e6e6e6',
                'mtv-gray-2': '#98989A',
                'mtv-text-gray': '#6f7271',       
                'mtv-text-gray-light': '#bbbbbb',
                'mtv-text-gray-extra-light': '#fbfbfb',
                danger: colors.red,
                primary: colors.teal,
                success: colors.green,
                warning: colors.yellow,
            },
            fontFamily: {
                sans: ['Source Sans Pro', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/line-clamp')
    ],
};
