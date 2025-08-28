import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        // Añadir node_modules de Flowbite para que funcionen sus componentes
        './node_modules/flowbite/**/*.js',
        './vendor/milenmk/laravel-simple-datatables-and-forms/resources/views/**/*.blade.php',,
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        require('flowbite/plugin')({
            datatable: true,
        }),
    ],
};
