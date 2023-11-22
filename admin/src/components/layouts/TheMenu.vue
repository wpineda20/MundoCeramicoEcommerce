<script setup>
import { RouterLink } from "vue-router";
import useMenu from "@/composables/useMenu";
import useAuth from "@/composables/useAuth";
import { ref } from "vue";

const { stateSideBar } = useMenu();
const { user, isLoggedIn, logout } = useAuth();
const { redirectAndGenerateChallenge } = useAuth();
const registerUrl = ref(import.meta.env.VITE_BACKEND_URL + "/register");
</script>

<template>
  <div class="menu-sidebar d-flex flex-column align-center" :class="stateSideBar">
    <div class="menu-button mt-5 mb-4">
      <a href="#" @click="stateSideBar = 'inactive'">
        <v-icon icon="mdi-close mt-1" :size="30"></v-icon>
      </a>
    </div>
    <div class="menu-options text-center">
      <!-- logged In -->
      <template v-if="isLoggedIn">
        <!-- home -->
        <RouterLink to="/" class="d-flex flex-row align-center mb-4 menu-el" @click="stateSideBar = 'inactive'">
          <v-icon icon="mdi-home mx-2" size="22"></v-icon>
          <span class="menu-text">Inicio</span>
        </RouterLink>
        <!-- home -->
        <!-- order -->
        <RouterLink to="/order" class="d-flex flex-row align-center mb-4 menu-el" @click="stateSideBar = 'inactive'">
          <v-icon icon="mdi-package-variant-closed mx-2" size="22"></v-icon>
          <span class="menu-text">Ordenes</span>
        </RouterLink>
        <!-- order -->
        <!-- user -->
        <RouterLink to="/user" class="d-flex flex-row align-center mb-4 menu-el" @click="stateSideBar = 'inactive'">
          <v-icon icon="mdi-account-group mx-2" size="22"></v-icon>
          <span class="menu-text">Usuarios</span>
        </RouterLink>
        <!-- user -->
        <!-- state -->
        <RouterLink to="/state" class="d-flex flex-row align-center mb-4 menu-el" @click="stateSideBar = 'inactive'">
          <v-icon icon="mdi-animation mx-2" size="22"></v-icon>
          <span class="menu-text">Estados</span>
        </RouterLink>
        <!-- state -->
        <!-- carousel -->
        <RouterLink to="/carousel" class="d-flex flex-row align-center mb-4 menu-el" @click="stateSideBar = 'inactive'">
          <v-icon icon="mdi-image-multiple mx-2" size="22"></v-icon>
          <span class="menu-text">Banners</span>
        </RouterLink>
        <!-- carousel -->
        <!-- localization -->
        <RouterLink to="/localization" class="d-flex flex-row align-center mb-4 menu-el"
          @click="stateSideBar = 'inactive'">
          <v-icon icon="mdi-store mx-2" size="22"></v-icon>
          <span class="menu-text">Tiendas</span>
        </RouterLink>
        <!-- localization -->
        <!-- logout -->
        <RouterLink to="/" class="d-flex flex-row align-center mb-4 menu-el">
          <v-icon icon="mdi-logout mx-2" size="22"></v-icon>
          <span class="menu-text" @click="logout()">Cerrar sesión</span>
        </RouterLink>
        <!-- logout -->
      </template>
      <!-- logged In -->
      <!-- logged out -->
      <template v-else>
        <!-- login -->
        <div class="d-flex flex-row align-center text-black fw-bold menu-el">
          <v-icon icon="mdi-login mx-2" size="22"></v-icon>
          <a @click="redirectAndGenerateChallenge()">Iniciar sesión</a>
        </div>
        <!-- login -->
      </template>
    </div>
  </div>
</template>
<!-- logged out -->


<style lang="scss">
@import "@/assets/styles/variables.scss";

.menu-sidebar {
  width: 100% !important;
  height: 100vh;
  position: fixed;
  top: 0;
  z-index: 10000 !important;
  background: #ffffff !important;
  font-size: 16px;
}

.menu-sidebar a {
  margin-bottom: 0px !important;
}

.menu-options {
  // display: flex;
  width: 100%;
  padding: 10px 0px;
}

.menu-text {
  font-weight: 600;
}

.menu-el {
  border-bottom: 1px solid #eee;
  padding: 10px 20px;
  margin-bottom: 0;
}

.menu-sidebar a {
  color: black !important;
}

.inactive {
  left: -100% !important;
  animation: linear;
  animation-name: hideMenu;
  animation-duration: 0.4s;
}

@keyframes hideMenu {
  0% {
    left: 0;
    transform: translateX(0);
  }

  100% {
    left: -100%;
    transform: translateX(-100%);
  }
}

.active {
  left: 0;
  animation: linear;
  animation-name: showMenu;
  animation-duration: 0.4s;
}

@keyframes showMenu {
  0% {
    left: -100%;
    transform: translateX(-100%);
  }

  100% {
    left: 0;
    transform: translateX(0);
  }
}
</style>