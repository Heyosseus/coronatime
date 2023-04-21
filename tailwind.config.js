/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
  ],
  theme: {
    extend: {
        fontFamily: {
            firago: ['firago', 'sans-serif'],
        },
        width:{
            'login-form' : '423px',
            'form': '393px',
            'img': '100vw',
            'cards' : '1000px'
        },
        colors:{
            'text-blue' : '#2029F3',
            'text-green': '#249E2C',
            'text-yellow': '#EAD621',
            'blue': '#2029F31A',
            'green': '#249E2C1A',
            'yellow': '#EAD6211A',
        },
        backgroundImage: theme => ({
            'gradient-blue': 'linear-gradient(109.6deg, #FCFF81 -18.12%, #C2FF9D 47.7%, #75A4FF 114.98%)',
        }),
        boxShadow: {
          'shadow':  "1px 2px 8px rgba(0, 0, 0, 0.04)"
        },

    },
  },
  plugins: [
      require('@tailwindcss/forms')({
          strategy: 'class', // only generate classes
      }),
      require('tailwind-scrollbar'),
  ],
}

