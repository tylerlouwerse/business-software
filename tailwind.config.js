/** @type {import('tailwindcss').Config} */
export default {
  content: ["./index.html", "./src/**/*.{vue,js,ts,jsx,tsx}"],
  theme: {
    extend: {
      colors: {
        primary: {
          50: "#faebec",
          100: "#f5d6d9",
          200: "#eaaeb3",
          300: "#e0858d",
          400: "#d55d67",
          500: "#cb3441",
          600: "#9d2933",
          700: "#7a1f27",
          800: "#51151a",
          900: "#3d1013",
          950: "#290a0d",
        },
      },
    },
  },
};
