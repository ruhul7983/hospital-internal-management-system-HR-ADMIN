/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",  // all blade files (layouts + child)
    "./resources/**/*.js",         // any JS using tailwind
  ],
  theme: {
    extend: {
      colors: {
        primary: "#1d4ed8", // blue-700 (you can change it)
        secondary: "#64748b", // slate-500
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),  // optional, for better form styles
    require('@tailwindcss/typography'), // optional, for prose content
  ],
};
