<script setup>
import { RouterLink } from "vue-router";
import useMenu from "@/composables/useMenu";
import useAuth from "@/composables/useAuth";
import useCart from "@/composables/useCart";
import { ref } from "vue";

const { stateSideBar } = useMenu();
const { user, isLoggedIn, logout } = useAuth();
const { redirectAndGenerateChallenge } = useAuth();
const { products } = useCart();

const registerUrl = ref(import.meta.env.VITE_BACKEND_URL + "/register");
const homeUrl = ref(import.meta.env.VITE_BACKEND_URL + "/home");
</script>

<template>
  <div class="menu-sidebar d-flex flex-column align-center" :class="stateSideBar">
    <div class="menu-button mt-5 mb-4">
      <a href="#" @click="stateSideBar = 'inactive'">
        <v-icon style="color: #000C27 !important;" icon="mdi-close mt-1" :size="30"></v-icon>
      </a>
    </div>
    <div class="menu-options text-center">
      <!-- logged In -->
      <template v-if="isLoggedIn">
        <!-- home -->
        <RouterLink to="/" class="d-flex flex-row align-center mb-4 menu-el" @click="stateSideBar = 'inactive'">
          <v-icon icon="mdi-home mx-2" size="22"></v-icon>
          <span class="menu-text">INICIO</span>
        </RouterLink>
        <!-- home -->
        <!-- services -->
        <RouterLink to="/services" class="d-flex flex-row align-center mb-4 menu-el" @click="stateSideBar = 'inactive'">
          <v-icon icon="mdi-hand-extended mx-2" size="22"></v-icon>
          <span class="menu-text">SERVICIOS</span>
        </RouterLink>
        <!-- services -->
        <!-- about -->
        <RouterLink to="/about" class="d-flex flex-row align-center mb-4 menu-el" @click="stateSideBar = 'inactive'">
          <v-icon icon="mdi-account-group mx-2" size="22"></v-icon>
          <span class="menu-text">NOSOTROS</span>
        </RouterLink>
        <!-- about -->
        <!-- contact -->
        <RouterLink to="/contact" class="d-flex flex-row align-center mb-4 menu-el" @click="stateSideBar = 'inactive'">
          <v-icon icon="mdi-phone mx-2" size="22"></v-icon>
          <span class="menu-text">CONTACTO</span>
        </RouterLink>
        <!-- contact -->
        <!-- cart -->
        <RouterLink to="/cart" class="d-flex flex-row align-center mb-4 menu-el" @click="stateSideBar = 'inactive'">
          <v-badge :content="products.length" color="error">
            <v-icon icon="mdi-cart mx-2" size="22"></v-icon>
          </v-badge>
        </RouterLink>
        <!-- cart -->
        <!-- account -->
        <a :href="homeUrl" class="d-flex flex-row align-center mb-4 menu-el">
          <v-icon icon="mdi-account mx-2" size="22"></v-icon>
          <span class="menu-text">CUENTA</span>
        </a>
        <!-- account -->
        <!-- account -->
        <RouterLink to="/myOrders" class="d-flex flex-row align-center mb-4 menu-el" @click="stateSideBar = 'inactive'">
          <v-icon icon="mdi-package-variant mx-2" size="22"></v-icon>
          <span class="menu-text">MIS PEDIDOS</span>
        </RouterLink>
        <!-- account -->
        <!-- logout -->
        <a class="d-flex flex-row align-center mb-4 menu-el" @click="stateSideBar = 'inactive'" style="cursor: pointer">
          <v-icon icon="mdi-logout mx-2" size="22"></v-icon>
          <span class="menu-text" @click="logout()">CERRAR SESIÓN</span>
        </a>
        <!-- logout -->
      </template>
      <!-- logged In -->
      <!-- logged out -->
      <template v-else>
        <!-- home -->
        <RouterLink to="/" class="d-flex flex-row align-center mb-4 menu-el" @click="stateSideBar = 'inactive'">
          <v-icon icon="mdi-home mx-2" size="22"></v-icon>
          <span class="menu-text">INICIO</span>
        </RouterLink>
        <!-- home -->
        <!-- services -->
        <RouterLink to="/services" class="d-flex flex-row align-center mb-4 menu-el" @click="stateSideBar = 'inactive'">
          <v-icon icon="mdi-hand-extended mx-2" size="22"></v-icon>
          <span class="menu-text">SERVICIOS</span>
        </RouterLink>
        <!-- services -->
        <!-- about -->
        <RouterLink to="/about" class="d-flex flex-row align-center mb-4 menu-el" @click="stateSideBar = 'inactive'">
          <v-icon icon="mdi-account-group mx-2" size="22"></v-icon>
          <span class="menu-text">NOSOTROS</span>
        </RouterLink>
        <!-- about -->
        <!-- contact -->
        <RouterLink to="/contact" class="d-flex flex-row align-center mb-4 menu-el" @click="stateSideBar = 'inactive'">
          <v-icon icon="mdi-phone mx-2" size="22"></v-icon>
          <span class="menu-text">CONTACTO</span>
        </RouterLink>
        <!-- contact -->
        <!-- login -->
        <div class="d-flex flex-row align-center text-black fw-bold menu-el" style="cursor: pointer">
          <v-icon icon="mdi-login mx-2" size="22"></v-icon>
          <a @click="redirectAndGenerateChallenge()">INICIAR SESIÓN</a>
        </div>
        <!-- login -->
        <div to="/" class="d-flex flex-row fw-bold text-black align-center mb-4 menu-el">
          <v-icon icon="mdi-account-plus mx-2" size="22"></v-icon>
          <a :href="registerUrl">REGISTRARSE</a>
        </div>
      </template>
    </div>
  </div>
</template>

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
  color: #000C27 !important;
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