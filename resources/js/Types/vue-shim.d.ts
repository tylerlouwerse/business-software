declare module "*.vue" {
  import { defineComponent } from "vue";

  const component: ReturnType<typeof defineComponent>;
  export default component;
}

/// <reference types="vite-svg-loader" />
declare module "*.svg?component" {
  import { DefineComponent } from "vue";
  const component: DefineComponent;
  export default component;
}
