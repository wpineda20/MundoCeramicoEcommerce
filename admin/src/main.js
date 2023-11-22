import { createApp } from "vue";
import { createPinia } from "pinia";
import { createVuetify } from "vuetify";

import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import { es } from "vuetify/locale";
import * as labs from "vuetify/labs/VDataTable";

import Vue3Toasity from "vue3-toastify";

import App from "./App.vue";
import router from "./router";

// Importing styles
import "./assets/styles/main.scss";
import "mapbox-gl/dist/mapbox-gl.css";
import "vue3-toastify/dist/index.css";

const vuetify = createVuetify({
  components: {
    ...components,
    ...labs,
  },
  directives,
  locale: {
    locale: "es",
    messages: { es },
  },
  icons: {
    defaultSet: "mdi", // This is already the default value - only for display purposes
  },
});

const app = createApp(App);

app.use(createPinia());
app.use(vuetify);
app.use(router);
app.use(Vue3Toasity);

app.mount("#app");
