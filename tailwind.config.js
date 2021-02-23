const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  future: {
    // removeDeprecatedGapUtilities: true,
    // purgeLayersByDefault: true,
  },
  purge: [],
  theme: {
    extend: {
      fontSize: {
        '7xl': '5rem',
        '8xl': '6rem',
        '9xl': '7rem',
        '10xl': '8rem',
      },
      fontFamily: {
          sans: ['Nunito', ...defaultTheme.fontFamily.sans],
      },
      spacing: {
        'header': '3.875rem',
      },
      inset: {
        'icon': '0.125rem',
      },
      minWidth: {
        'dropdown': '250px',
      },
      height: {
        'screen-10': '10vh',
        'screen-20': '20vh',
        'screen-30': '30vh',
        'screen-40': '40vh',
        'screen-50': '50vh',
        'screen-60': '60vh',
        'screen-70': '70vh',
        'screen-80': '80vh',
        'screen-90': '90vh',
      },
      minHeight: {
        'hero': '680px',
        '1/2': '50%',
      },
      colors: {
        primary: {
          '100': '#545d77',
          '200': '#4a5269',
          '300': '#40475b',
          '400': '#353c4d',
          '500': '#2a2f3d',
          '600': '#212530',
          '700': '#171921',
          '800': '#0d0f13',
          '900': '#030405',
        },
        secondary: {
          '100': '#00f2ff',
          '200': '#01e6f2',
          '300': '#01dae5',
          '400': '#00ced8',
          '500': '#00c3cc',
          '600': '#01b7bf',
          '700': '#00aab1',
          '800': '#009ca2',
          '900': '#008f94',
        },
        accent: {
          '100': '#ff926e',
          '200': '#ff875f',
          '300': '#fe7c50',
          '400': '#ff7140',
          '500': '#ff6732',
          '600': '#fe5d25',
          '700': '#ff5317',
          '800': '#fe490a',
          '900': '#ff4200',
        },
        terciary: {
          '100': '#fee178',
          '200': '#ffdf6b',
          '300': '#fedb5c',
          '400': '#fed84d',
          '500': '#ffd63e',
          '600': '#fed22e',
          '700': '#ffd01f',
          '800': '#ffcd0f',
          '900': '#ffca00',
        },
        salva: '#ff1d58'
      },
      zIndex: {
        '25': 25,
        '75': 75,
        '100': 100,
        '150': 150,
        '200': 200,
        '250': 250,
        '250': 250,
        '500': 500,
        '1000': 1000,
        '1500': 1500,
        '2000': 2000,
      },
    },
  },
  variants: {
    opacity: ['responsive', 'hover', 'focus', 'disabled'],
    backgroundColor: ['responsive', 'hover', 'focus', 'active']
  },
  plugins: [],
}