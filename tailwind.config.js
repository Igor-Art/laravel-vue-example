import colors from 'tailwindcss/colors'

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    container: {
      center: true,
      padding: '1rem',
    },
    extend: {
      colors: {
        primary: colors.gray['200'],
        secondary: colors.gray['400'],
        app: {
          primary: colors.sky['500'],
          body: '#2e214e',
          danger: '#ff2498',
          warning: colors.yellow['200'],
          success: '#6df825',
          link: {
            active: colors.sky['300'],
          },
        },
      }
    },
  },
  plugins: [],
}

