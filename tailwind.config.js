/** @type {import('tailwindcss').Config} */
export default {
  content: [
    // -- todos los archivos .blade.php --//
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php"

  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

