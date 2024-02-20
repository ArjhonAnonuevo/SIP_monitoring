/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{php,js}"],
  theme: {
     extend: {
      fontFamily: {
         'poppins': ['Poppins', 'sans-serif'],
       },
       backgroundImage: {
        'custom-bg': "url('../interns account/sec.png')",
      },
     },
  },
  plugins: [],
 }
 