import { createApp, h } from "vue";
import type { DefineComponent } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import PrimeVue from "primevue/config";
import { AppTheme } from "@/theme";
import { ZiggyVue } from "ziggy-js";
import { createPinia } from "pinia";
import { configureEcho } from "@laravel/echo-vue";
import "../css/app.css";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

configureEcho({
  broadcaster: "reverb",
});

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) =>
    resolvePageComponent(
      `./Pages/${name}.vue`,
      import.meta.glob<DefineComponent>("./Pages/**/*.vue")
    ),
  setup({ el, App, props, plugin }) {
    const pinia = createPinia();
    return createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(PrimeVue, { theme: { preset: AppTheme } })
      .use(ZiggyVue)
      .use(pinia)
      .mount(el);
  },
  progress: {
    color: "#4B5563",
  },
});
