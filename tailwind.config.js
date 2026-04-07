import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
const plugin = require('tailwindcss/plugin');

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './resources/js/**/*.jsx', 
        'Modules/Crm/Resources/js/**/*.jsx',
        './resources/views/auth/*.blade.php',
        './resources/views/components/public/*.blade.php',
        './resources/views/components/public/footer.blade.php',
        './resources/views/public/index.blade.php',
        './resources/views/components/public/matrix.blade.php'
    ],
    darkMode: 'class',
    theme: {
        screens: {
            'xs': '320px',
            "2xs": "370px",
            'sm': "640px",
            'md': "768px",
            "2md": "900px",
            'lg': "1024px",
            "2lg": "1100px",
           'xl': "1280px",
           mxl:"1350px",
            '2xl': "1350px",
            '3xl': "1530px"
        },
        extend: {
            keyframes: {
                jump: {
                  '0%, 100%': { transform: 'translateY(0)' },
                  '50%': { transform: 'translateY(-10px)' },
                },

                fadeUp: {
                    '0%': {
                      opacity: '0',
                      transform: 'translateY(20px)',
                    },
                    '100%': {
                      opacity: '1',
                      transform: 'translateY(0)',
                    },
                },
            },
            colors: {
                customGreen: '#32B3AD',
              },
            animation: {
                jump: 'jump 1s ease-in-out infinite',
                'fade-up': 'fadeUp 0.6s ease-out forwards',
            },
            stroke: (theme) => ({
                custom: theme("colors.black"),
                strokeWithe: "#ffffff",
              }),
            fill: (theme) => ({
                bgAzul: "#254F9A",
                bgAzul: "#0071BE",
                bgWhite: "#ffffff",
                bgBlack: "#000000",
              }),
            fontWeight: {
                medium: "500",
                regular: "400",
                semibold: "600",
              },
            boxShadow: {
                DEFAULT: '0 1px 3px 0 rgba(0, 0, 0, 0.08), 0 1px 2px 0 rgba(0, 0, 0, 0.02)',
                md: '0 4px 6px -1px rgba(0, 0, 0, 0.08), 0 2px 4px -1px rgba(0, 0, 0, 0.02)',
                lg: '0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.01)',
                xl: '0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 10px 10px -5px rgba(0, 0, 0, 0.01)',
            },
            outline: {
                blue: '2px solid rgba(0, 112, 244, 0.5)',
            },
            fontFamily: {
                dm_sans: ['DM Sans', 'sans-serif'],
                dm_serif: ['DM Serif Display', 'serif'],
                geist: ['Geist', 'sans-serif'], 
                plus_jakarta: ['Plus Jakarta Sans', 'sans-serif'],
                PlusJakartaSans_Regular: ["PlusJakartaSans-Regular"],
                PlusJakartaSans_Bold: ["PlusJakartaSans-Bold"],
            },
            fontSize: {
                xs: ['0.75rem', { lineHeight: '1.5' }],
                sm: ['0.875rem', { lineHeight: '1.5715' }],
                base: ['1rem', { lineHeight: '1.5', letterSpacing: '-0.01em' }],
                lg: ['1.125rem', { lineHeight: '1.5', letterSpacing: '-0.01em' }],
                xl: ['1.25rem', { lineHeight: '1.5', letterSpacing: '-0.01em' }],
                '2xl': ['1.5rem', { lineHeight: '1.33', letterSpacing: '-0.01em' }],
                '3xl': ['1.88rem', { lineHeight: '1.33', letterSpacing: '-0.01em' }],
                '4xl': ['2.25rem', { lineHeight: '1.25', letterSpacing: '-0.02em' }],
                '5xl': ['3rem', { lineHeight: '1.25', letterSpacing: '-0.02em' }],
                '6xl': ['3.75rem', { lineHeight: '1.2', letterSpacing: '-0.02em' }],
                mediumSize: "56px",
                regularSize: "18px",
                basicSize: "16px",
                basic: "14px",
                basicLittle: "12px",
                subtitle: "48px",
                littleTitle: "24px",
                middleTitle: "40px",
                middle: "32px",
                text10: "10px",
                text12: "12px",
                text14: "14px",
                text16: "16px",
                text18: "18px",
                text20: "20px",
                text22: "22px",
                text24: "24px",
                text28: "28px",
                text32: "32px",
                text36: "36px",
                text40: "40px",
                text44: "44px",
                text48: "48px",
                text52: "52px",
                text56: "56px",
                text60: "60px",
                text64: "64px",
                text68: "68px",
                text72: "72px",
                text74: "74px",
                text80: "80px",
                text90: "90px",
                text100: "100px",
                text135: "135px",
                text145: "145px",
                text160: "160px",
            },

            backgroundColor: {
                colorBackgroundHeader: "#21201E",
                colorBackgroundMainTop: "#21201E",
                colorBackgroundProducts: "#F8F6F2",
                colorBackgroundNewProduct: "#38CB89",
                bgBlack: "#000000",
                bgWhite: "#FFFFFF",
                bgButtonBaseGreen: "#BFDE8E",
                bgRosa: "#F5F5F5",
              },
              textColor: {
                colorSubtitle: "#113E55",
                colorSubtitleLittle: "#173525",
                colorAdd: "#2D694B",
                colorTextBlack: "#151515",
                textWhite: "#FFFFFF",
                textWhiteWeak: "#FCFBFA",
                textAzul: "#00395F",
                textBlack: "#111111",
                textGray: "#A6A6A6",
              },
              borderColor: {
                selectCheck: "#173525",
                colorBorder: "#151515",
              },

              backgroundImage: {
                "close-menu": "url(../images/prueba/icon-close.svg)",
                "open-menu": "url(../images/prueba/icon-hamburger.svg)",
              },

            
            borderWidth: {
                3: '3px',
            },
            minWidth: {
                36: '9rem',
                44: '11rem',
                56: '14rem',
                60: '15rem',
                72: '18rem',
                80: '20rem',
            },
            maxWidth: {
                '8xl': '88rem',
                '9xl': '96rem',
            },
            zIndex: {
                60: '60',
            },
            boxShadow: {
                'custom-light': '0px 4px 10px rgba(49, 51, 50, 0.9)',
              
            },
        },
    },

    plugins: [
        // require('tailwindcss-animated'),
        forms,
        typography,
        // add custom variant for expanding sidebar
        plugin(({ addVariant, e }) => {
            addVariant('sidebar-expanded', ({ modifySelectors, separator }) => {
                modifySelectors(({ className }) => `.sidebar-expanded .${e(`sidebar-expanded${separator}${className}`)}`);
            });
        }),
      
    ],
};
