<script setup>
import { ref, onMounted } from "vue";

import TheFooter from "./components/layouts/TheFooter.vue";
import TheHeader from "./components/layouts/TheHeader.vue";
import useAuth from "./composables/useAuth";
import TheMenu from "./components/layouts/TheMenu.vue";
import Alert from "@/components/layouts/Alert.vue";
import { useRoute, useRouter } from "vue-router";
import BreadCrumb from "./components/BreadCrumb.vue";

const { getUserInfo, logout, state, verifier, accessToken, refreshToken } =
  useAuth();

const route = useRoute();

const elementoDisplay = ref("none");

const handleScroll = () => {
  if (window.scrollY > 600) {
    elementoDisplay.value = "block";
  } else {
    elementoDisplay.value = "none";
  }
};

onMounted(async () => {
  window.addEventListener("scroll", handleScroll);

  accessToken.value = localStorage.getItem("access_token");
  refreshToken.value = localStorage.getItem("refresh_token");
  state.value = localStorage.getItem("state");
  verifier.value = localStorage.getItem("verifier");

  const path = window.location.pathname;
  if (path == "/login" || path == "/callback") {
    return;
  }

  if (!accessToken.value) {
    logout();
    return;
  }

  await getUserInfo();
});
</script>

<template>
  <the-header />
  <the-menu />

  <main id="main">
    <!-- <Alert /> -->

    <!-- <v-container class="py-5 pb-0"> -->
    <BreadCrumb :locations="route.meta.breadCrumb" divider="/" />
    <!-- </v-container> -->

    <RouterView />
    <a href="#" class="btnScrollToTop" :style="{ display: elementoDisplay }">
      <v-icon style="color: #fff !important" icon="mdi-chevron-up"></v-icon>
    </a>
  </main>

  <the-footer />
</template>