import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#f8f9fa',
                    100: '#f1f3f5',  
                    200: '#e9ecef',
                    300: '#dee2e6',
                    400: '#ced4da',
                    500: '#2C3E50',
                    600: '#233240',
                    700: '#1a252f',
                    800: '#11181f',
                    900: '#080c0f',
                },
                secondary: {
                    50: '#f5f9ff',
                    100: '#ebf3fe',
                    200: '#d0e1fd',
                    300: '#b5cffc',
                    400: '#7facfa',
                    500: '#34495E',
                    600: '#2a3a4b',
                    700: '#1f2c38',
                    800: '#151d26',
                    900: '#0a0f13',
                },
                accent: {
                    50: '#fff5f5',
                    100: '#ffe3e3',
                    200: '#ffc9c9',
                    300: '#ffa8a8',
                    400: '#ff8787',
                    500: '#E74C3C',
                    600: '#c0392b',
                    700: '#962c22',
                    800: '#6b1f18',
                    900: '#40130e',
                }
            }
        },
    },

    plugins: [forms],
};