/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["SIP/{application forms,attendance,certifications,dashboard,interns account, monthly reports, tailwind}/**/*.{php,js}"],
  theme: {
    fontFamily: {
      'sans': ['Montserrat', 'sans-serif'],
    }
  },
  plugins: [
    require('@tailwindcss/typography'),
  ],
}

