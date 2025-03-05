import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',

        "./vendor/robsontenorio/mary/src/View/Components/**/*.php",

        './app/Livewire/**/*Table.php',
        './vendor/power-components/livewire-powergrid/resources/views/**/*.php',
        './vendor/power-components/livewire-powergrid/src/Themes/Tailwind.php'
    ],

    presets: [
        require("./vendor/power-components/livewire-powergrid/tailwind.config.js")
    ],

    daisyui: {
        themes: [
            {
                light: {
                    ...require("daisyui/src/theming/themes")["nord"],
                },
            }, 'dark'
        ],
    },

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            }
        },
    },

    plugins: [
        forms,
        require("daisyui")
    ],
};
