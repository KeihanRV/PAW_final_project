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
                orator: ["Orator Std", "sans-serif"],
            },
            colors: {
                'brand-page-bg': '#73553C', // Background halaman luar (OK)
                'brand-card-bg': '#D9D1BD', // Background halaman luar (OK)
                'brand-cream': '#D9D1BD',   // <-- INI untuk background kartu
                'brand-brown': '#4A3F35',   // <-- INI untuk input DAN teks gelap
                'brand-orange': '#F9A826',  // Tombol submit
                'brand-orange-hover': '#E89A1F', // Hover tombol submit
            },
            backgroundImage: {
                // Definisikan gambar Anda di sini
                "login-image": "url('../images/login-bg.jpg')",
                "register-image": "url('../images/register-bg.jpg')",
                "forgot-image": "url('../images/forgot-bg.jpg')",
            },
        },
    },

    plugins: [forms],
};
