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
            'form': '40vw',
            'img': '100vw',
        }
    },
  },
  plugins: [
      require('@tailwindcss/forms')({
          strategy: 'class', // only generate classes
      }),
  ],
}

