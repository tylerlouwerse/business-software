/** @type {import('tailwindcss').Config} */
export default {
  content: ["./index.html", "./src/**/*.{vue,js,ts,jsx,tsx}"],
  theme: {
    extend: {
      colors: {
        primary: {
          50: "#eef2f6",
          100: "#dee6ed",
          200: "#bcccdc",
          300: "#9bb3ca",
          400: "#7999b9",
          500: "#5880a7",
          600: "#466686",
          700: "#354d64",
          800: "#233343",
          900: "#121a21",
          950: "#090d11",
        },
      },
      fontSize: {
        "3xs": "0.4rem",
        "2xs": "0.5rem",
        xs: "0.75rem",
      },
    },
  },
};
