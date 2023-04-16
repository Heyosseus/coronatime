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
            'bg-blue': '#2029F31A',
            'bg-green': '#249E2C1A',
            'bg-yellow': '#EAD6211A',
            'gradient': 'gradient-to-br from-yellow-300 via-green-400 to-blue-500'
        },
        boxShadow: {
          'shadow':  "1px 2px 8px rgba(0, 0, 0, 0.04)"
        }

    },
  },
  plugins: [
      require('@tailwindcss/forms')({
          strategy: 'class', // only generate classes
      }),
  ],
}

