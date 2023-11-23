<script setup>
import useAuth from "@/composables/useAuth";

import { RouterLink } from "vue-router";
import useMenu from "@/composables/useMenu";
import { onMounted, ref } from "vue";
import { toast } from "vue3-toastify";

const { stateSideBar } = useMenu();

const { user, isLoggedIn, logout } = useAuth();
const { redirectAndGenerateChallenge } = useAuth();

const registerUrl = ref(import.meta.env.VITE_BACKEND_URL + "/register");
const homeUrl = ref(import.meta.env.VITE_BACKEND_URL + "/home");

</script>

<template>
  <header class="header style7">
    <div class="header-nav-container rows-space-20">
      <v-container class="pt-0 pb-0">
        <div class="header-nav-wapper main-menu-wapper">
          <div class="vertical-wapper block-nav-categori" style="background: transparent">
            <div class="block-title" style="padding: 10px; margin-bottom: 15px;">
              <a href="#">
                <img src="/logos/logo_azul_negro_rombo_rojo.png" alt="img" width="100" />
              </a>
            </div>
          </div>
          <div class="header-nav">
            <div class="container-wapper">
              <ul class="zentimo-clone-mobile-menu zentimo-nav main-menu" id="menu-main-menu">
                <li class="menu-item">
                  <RouterLink to="/" class="zentimo-menu-item-title">
                    <a class="zentimo-menu-item-title" v-if="isLoggedIn" title="Home">Inicio</a>
                  </RouterLink>
                </li>
                <li class="menu-item">
                  <RouterLink to="/order" class="zentimo-menu-item-title">
                    <a title="Pedidos" v-if="isLoggedIn">Pedidos</a>
                  </RouterLink>
                </li>
                <li class="menu-item">
                  <RouterLink to="/user" class="zentimo-menu-item-title">
                    <a title="Usuarios" v-if="isLoggedIn">Usuarios</a>
                  </RouterLink>
                </li>
                <li class="menu-item">
                  <RouterLink to="/state" class="zentimo-menu-item-title">
                    <a title="Estados" v-if="isLoggedIn">Estados</a>
                  </RouterLink>
                </li>
                <li class="menu-item">
                  <RouterLink to="/carousel" class="zentimo-menu-item-title">
                    <a title="Baner" v-if="isLoggedIn">Banners</a>
                  </RouterLink>
                </li>
                <li class="menu-item">
                  <RouterLink to="/localization" class="zentimo-menu-item-title">
                    <a title="state" v-if="isLoggedIn">Tiendas</a>
                  </RouterLink>
                </li>

                <li class="menu-item">
                  <div class="block-account block-header zentimo-dropdown mt-5 mb-5">
                    <a style="cursor: pointer" class="mt-2" v-if="isLoggedIn">
                      <v-badge dot color="success">
                        <v-icon :size="24" class="m-0" icon="mdi-account"></v-icon>
                      </v-badge>
                    </a>
                    <div class="header-account zentimo-submenu m-0">
                      <div class="header-user-form-tabs">
                        <ul class="tab-link">
                          <li class="active" v-if="user">
                            <a href="#" class="fw-bold">{{ user.name }} - Administrador</a>
                          </li>
                        </ul>
                        <div class="tab-container">
                          <div id="header-tab-login" class="tab-panel active">
                            <div class="login form-login px-5 py-3">
                              <a :href="homeUrl" taget="_blank"
                                class="form-row pb-5 pt-2 form-row-wide fw-bold text-black" style="cursor: pointer">
                                Mi Cuenta
                              </a>
                              <p class="form-row pt-2">
                                <a href="#" class="button" @click="logout()">Cerrar sesión</a>
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="menu-item" style="margin-left:300px">
                  <RouterLink to="/" @click="redirectAndGenerateChallenge()" v-if="!isLoggedIn"
                    class="zentimo-menu-item-title">
                    <a title="state">Iniciar sesión</a>
                  </RouterLink>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </v-container>
    </div>

    <div class="header-device-mobile">
      <div class="wapper">
        <!-- logo mobile -->
        <div class="item mobile-logo">
          <div class="logo">
            <a href="#">
              <img src="/logos/logo_azul_negro_rombo_rojo.png" alt="logo mundo ceramico" height="50" />
            </a>
          </div>
        </div>
        <!-- logo mobile -->
        <!-- menu -->
        <div class="item mobile-menu-box has-sub">
          <a href="#" @click="stateSideBar = 'active'">
            <span class="icon">
              <v-icon icon="mdi-menu" :size="30"></v-icon>
            </span>
          </a>
        </div>
        <!-- menu -->
      </div>
    </div>
  </header>
</template>

<style lang="scss">
@import "@/assets/styles/variables.scss";

.menu-sidebar {
  width: 6rem;
  height: 100vh;
  position: fixed;
  top: 0;
  z-index: 1;
  background: $menu-color;
  font-size: 16px;
}

.menu-sidebar a {
  color: white;
}

.inactive {
  left: -6rem;
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
    left: -6rem;
    transform: translateX(-6rem);
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
    left: -6rem;
    transform: translateX(-6rem);
  }

  100% {
    left: 0;
    transform: translateX(0);
  }
}
</style>