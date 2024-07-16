/** @type {import('tailwindcss').Config} */
module.exports = {
content: [
    
    "./**/*.{js,ts,jsx,tsx,php}",
  ],
  theme: {
    fontFamily:{
      
    },
    extend: {
      animation:{
        "cart_saltar":"cart_saltar 8s infinite ",
        "btn_saltar":"btn_saltar 4s infinite ",
        "pulse-fade-in": "pulse-fade-in 0.6s ease-out",
        "blurred-fade-in": "blurred-fade-in 0.4s ease-in-out",
        "rotate-in": "rotate-in 0.6s ease-out",
        "zoom-out": "zoom-out 1s infinite ",
        "transitionToLefft":"transitionToLefft 8s ease-in-out",
        "text-gradient": "text-gradient 1.5s linear infinite",
        "wooAjaxCheckLoading": "wooAjaxCheckLoading 1.5s linear infinite",
        
        "CarMove": "CarMove 15s linear infinite",
      },
      keyframes:{
        "wooAjaxCheckLoading":{
          "to":{"opacity": "0"}
          
        },
        "CarMove":{
          "to":{"transform": "translateX(150%)"}
          
        },
        "text-gradient": {
          "to": {
            "backgroundPosition": "200% center"
      }
    },
    

        "transitionToLefft":{
          "0%": {
            "transform": "translateX(50%)"
          },
          "100%": {
            "transform": "translateX(-100%)"
          },
        },
        "zoom-out": {
          "0%": {
            "opacity": "1",
            "transform": "scale(1)"
          },
          "100%": {
            "opacity": "0.4",
            "transform": "scale(.5)"
          }
        },

        "cart_saltar":{
          "0%":{"transform": "rotate(5deg)"},
          "2%":{"transform": "rotate(-5deg)"},
          "4%":{"transform": "rotate(5deg)"},
          "6%":{"transform": "rotate(-5deg)"},
          "8%":{"transform": "rotate(5deg)"},
          "10%":{"transform": "rotate(-5deg)"},
          "12%":{"transform": "rotate(0deg)"},
          "100%":{"transform": "rotate(0deg)"},
        },
        "btn_saltar":{
          "0%":{"transform": "rotate(5deg)"},
          "2%":{"transform": "rotate(-5deg)"},
          "4%":{"transform": "rotate(5deg)"},
          "6%":{"transform": "rotate(-5deg)"},
          "8%":{"transform": "rotate(5deg)"},
          "10%":{"transform": "rotate(-5deg)"},
          "12%":{"transform": "rotate(0deg)"},
          "100%":{"transform": "rotate(0deg)"},
        },


        "rotate-in": {
          "0%": {
            "opacity": "0",
            "transform": "rotate(-90deg)"
          },
          "100%": {
            "opacity": "1",
            "transform": "rotate(0deg)"
          }
        },
        "blurred-fade-in": {
          "0%": {
            "filter": "blur(5px)",
            "opacity": "0"
          },
          "100%": {
            "filter": "blur(0)",
            "opacity": "1"
          }
        },
        "pulse-fade-in": {
          "0%": {
            "transform": "scale(0.9)",
            "opacity": "0"
          },
          "50%": {
            "transform": "scale(1.05)",
            "opacity": "0.5"
          },
          "100%": {
            "transform": "scale(1)",
            "opacity": "1"
          }
        }
      },
      backgroundImage: {
        "gradient-radial": "radial-gradient(var(--tw-gradient-stops))",
        "gradient-conic":
          "conic-gradient(from 180deg at 50% 50%, var(--tw-gradient-stops))",
      },
    },
  },
  plugins: [],
}

