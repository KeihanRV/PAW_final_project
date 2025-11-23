import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Fredoka", ...defaultTheme.fontFamily.sans],
                orator: ["Orator Std", "monospace"],
                reenie: ['"Reenie Beenie"', "cursive"],
            },
            colors: {
                'brand-page-bg': '#73553C',
                'brand-card-bg': '#D9D1BD', 
                'brand-cream': '#D9D1BD',   
                'brand-brown': '#4A3F35',   
                'brand-orange': '#F9A826',
                'brand-orange-hover': '#E89A1F',
                'brand-second': '#E3D7BA',
                'brand-input-bg': '#E3D7BA',
                'brand-red': '#D92525',

            },
            backgroundImage: {
                "login-image": "url('../images/login-bg.jpg')",
                "register-image": "url('../images/register-bg.jpg')",
                "forgot-image": "url('../images/forgot-bg.jpg')",
            },
        },
    },

    plugins: [forms],
};
