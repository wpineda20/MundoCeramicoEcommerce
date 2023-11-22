import { createApp } from "vue";
import { createPinia } from "pinia";
import { createVuetify } from "vuetify";
import VueMask from '@devindex/vue-mask';

import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import { es } from "vuetify/locale";
import * as labs from "vuetify/labs/VDataTable";
import BreadCrum from "@/components/BreadCrumb.vue"

import Vue3Toasity from "vue3-toastify";

import App from "./App.vue";
import router from "./router";

// Importing styles
import "./assets/styles/main.scss";
import "mapbox-gl/dist/mapbox-gl.css";
import "vue3-toastify/dist/index.css";
import { VueReCaptcha } from "vue-recaptcha-v3";

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
app.use(VueMask);
app.use(VueReCaptcha, {
  siteKey: import.meta.env.VITE_SITE_API_KEY,
  loaderOptions: {
    useRecaptchaNet: true,
    autoHideBadge: true
  }
})

app.mount("#app");
