import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    // ត្រូវតែមានមួយបន្ទាត់នេះ ដើម្បីឱ្យប្រព័ន្ធប្ដូរពណ៌ ស-ខ្មៅ អូតូទូទាំងប្រព័ន្ធនៅពេលចុចប៊ូតុង
    darkMode: 'class', 

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};