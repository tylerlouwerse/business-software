import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import tailwindcss from "@tailwindcss/vite";
import svg from "vite-svg-loader";
import path from "path";

export default defineConfig({
  build: {
    sourcemap: false,
  },
  plugins: [
    laravel({
      input: ["resources/css/app.css", "resources/js/app.js"],
      refresh: true,
    }),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
      },
      compilerOptions: {
        isCustomElement: (tag) => tag?.startsWith("svg:"),
      },
    }),
    svg(),
    tailwindcss(),
  ],
  resolve: {
    alias: {
      "@": path.resolve(__dirname, "resources/js"),
    },
  },
});
